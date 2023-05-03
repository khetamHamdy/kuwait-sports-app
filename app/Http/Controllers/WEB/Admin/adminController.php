<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\ContestUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class adminController extends Controller
{
    use imageTrait;


    public function index(Request $request)
    {
        $items = Admin::where('id', '!=', auth('admin')->user()->id)
            ->where('id', '!=', '1')
            ->filter()
            ->orderByDesc('id')->paginate();
        return view('admin.admin.home', [
            'items' => $items,
        ]);

    }

    public function destroy($id)
    {
        $item = Admin::query()->findOrFail($id);
        if ($item && $item->type != 1) {
            Admin::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }


    public function create()
    {
        $users = Admin::all();
        $roles = Role::orderBy('id', 'desc')->get();
        return view('admin.admin.create', compact('users', 'roles'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',
            'mobile' => 'required|digits_between:8,12|unique:admins',
            'roles' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAdmin = new Admin();
        $newAdmin->name = $request->name;
        $newAdmin->email = $request->email;
        $newAdmin->password = bcrypt($request->password);
        $newAdmin->mobile = $request->mobile;
        $newAdmin->status = 'active';

        $newAdmin->save();

        if ($request->roles != null) {
            foreach ($request->roles as $roleId) {
                $values[] = [
                    'admin_id' => $newAdmin->id,
                    'role_id' => $roleId,
                ];
            }
            AdminRole::insert($values);

        }

        return redirect()->route('admin.admins.all')->with('success', __('done_added'));

    }

    public function edit($id)
    {
        //dd($id);
        $item = Admin::with('roles')->findOrFail($id);
        $roles = Role::orderBy('id', 'desc')->get();
        return view('admin.admin.edit', compact('item', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $newAdmin = Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'mobile' => 'required|digits_between:8,12|unique:admins,mobile,' . $newAdmin->id,
            'email' => 'required|email|unique:admins,email,' . $newAdmin->id,
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $check = Admin::where('email', $request->email)->where('id', '<>', $id)->first();
        if ($check) {
            $validator = [__('whoops')];
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newAdmin->name = $request->name;
        $newAdmin->mobile = $request->mobile;
        $newAdmin->email = $request->email;

        $newAdmin->save();

        if ($request->roles != null) {
            foreach ($request->roles as $roleId) {
                $values[] = [
                    'admin_id' => $newAdmin->id,
                    'role_id' => $roleId,

                ];
            }
            AdminRole::where('admin_id', $newAdmin->id)->delete();
            AdminRole::insert($values);

        }

        return redirect()->back()->with('info', __('done_update'));

    }


    public function edit_password(Request $request, $id)
    {
        $item = Admin::findOrFail($id);
        return view('admin.admin.edit_password', ['item' => $item]);
    }


    public function update_password(Request $request, $id)
    {
        $users_rules = array(
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',
        );
        $users_validation = Validator::make($request->all(), $users_rules);

        if ($users_validation->fails()) {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = Admin::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();


        return redirect()->back()->with('info', __('done_update'));
    }


    public function editAdmin()
    {
        $id = Auth::guard('admin')->id();

        $item = Admin::findOrFail($id);

        return view('admin.admin.edit_profile', compact('item'));
    }

    public function updateProfile(Request $request)
    {
        $newAdmin = Auth::guard('admin')->user();

        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'name' => 'required|string',
            'mobile' => 'required|digits_between:8,12|unique:users,phone,' . Auth::guard('admin')->id(),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $newAdmin->update($data);
        return redirect()->back()->with('info', __("done_update"));

    }


    public function changeMyPassword()
    {
        $item = Auth::guard('admin')->user();

        return view('admin.admin.changeMyPassword', compact('item'));
    }

    public function updateMyPassword(Request $request)
    {
        $users_rules = array(
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',
        );
        $users_validation = Validator::make($request->all(), $users_rules);

        if ($users_validation->fails()) {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = Auth::guard('admin')->user();
        $user->password = bcrypt($request->password);
        $user->save();
        if ($user) {
            return redirect()->route('admin.home')->with('info', __("done_update"));
        }
        return redirect()->back()->with('info', __("done_update"));
    }

}
