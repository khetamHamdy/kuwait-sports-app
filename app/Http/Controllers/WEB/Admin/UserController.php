<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Exports\SubscribeExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\ContestUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    use imageTrait;

    public function __construct()
    {
        $route = Route::currentRouteAction();
        $route_name = substr($route, strpos($route, "@") + 1);
        $this->middleware(function ($request, $next) use ($route_name) {
//            if (can('admins')) {
//                return $next($request);
//            }
            if ($route_name == 'index') {
                if (can(['users-show', 'users-create', 'users-edit', 'users-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create') {
                if (can('users-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit_user' || $route_name == 'update_user') {
                if (can('users-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy') {
                if (can('users-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->route('admin.home')->with('info', __('you dont have permeation'));
        });
    }

//users
    public function edit_user(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update_user(User $user, Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($user) {
            $user->update($request->all());
            return redirect()->route('admin.users.index')->with('info', __('done_update'));
        }
        return redirect()->back()->with('info', __('done_update'));
    }

    public function getItems($req, $user_id, Request $request)
    {
        $user = User::findOrFail($user_id);
        if ($req === 'change_profile') {
            $view = view('admin.users.edit_profile', ['user' => $user])->render();
            return response()->json(['items' => $view]);
        }

        if ($req === 'change_password') {
            $view = view('admin.users.edit_password', ['user' => $user])->render();
            return response()->json(['items' => $view]);
        }

        if ($req === 'image_contest') {
            $contest_user = ContestUser::where('user_id', '=', $user_id)->first();

            $view = view('admin.users.contest_photo',
                ['user' => $user, 'contest_user' => $contest_user])->render();
            return response()->json(['items' => $view]);
        }
    }

    public function update_password_user(User $user, Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);
            return redirect()->route('admin.users.index')->with('info', __("done_update"));
        }
        return redirect()->back()->with('info', __('done_update'));
    }

    public function create(User $user)
    {
        return view('admin.users.create', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'min:8'],
            'image' => ['required', 'mimes:jpeg,png,jpg,gif'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->img($request, 'image');
        }

        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if ($user) {
            return redirect()->back()->with('success', __('done_added'));
        }
    }

    public function index(Request $request)
    {
        $user = User::filter($request)->latest()->paginate();

        return view('admin.users.home', compact('user'));
    }

    public function export_user(Request $request)
    {
        return Excel::download(new UsersExport(), 'Users.xlsx');
    }
}
