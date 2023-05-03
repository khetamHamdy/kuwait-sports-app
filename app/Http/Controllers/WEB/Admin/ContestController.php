<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Contest;
use App\Models\ContestUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ContestController extends Controller
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
                if (can(['contest-show', 'contest-create', 'contest-edit', 'contest-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('contest-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('contest-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('contest-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->route('admin.home')->with('info', __('you dont have permeation'));
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
//  return Contest::with('user')->get();
        //return Contest::with('users')->get();
//        $contestUser = ContestUser::whereMonth('created_at', '=', date('m'))->max('count_like');

//        $params = $request->status;
//        $dataContest = ContestUser::filter($params)->latest()->paginate();
//        $lastDayThisMonth = date("Y-m-t");
//        return $lastDayThisMonth;
        $params = $request->status;
        $dataContest = Contest::filter($params)->latest()->paginate(10);
        return view('admin.contestAdmin.home', compact('dataContest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $status = [
            'active' => 'Active', 'not_active' => 'Not Active'
        ];
        return view('admin.contestAdmin.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->Roles($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->img($request, 'image');
        }

        if ($request->hasFile('video')) {
            $data['video'] = $this->img($request, 'video');
        }

        $contest = Contest::create($data);

        if ($contest) {
            return redirect()->route('admin.contest.index')->with('success', __('done_added'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contest $contest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Contest $contest)
    {
        $contest = $contest->load('users');
        return view('admin.contestAdmin.show', compact('contest'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contest $contest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Contest $contest)
    {
        $status = [
            'active' => 'Active', 'not_active' => 'Not Active'
        ];
        $close = [
            '1' => 'True', '0' => 'False'
        ];
        return view('admin.contestAdmin.edit', compact('contest', 'status', 'close'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contest $contest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Contest $contest)
    {
        $data = $request->all();

        $this->Roles($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->img($request, 'image');
        }

        if ($request->hasFile('video')) {
            $data['video'] = $this->img($request, 'video');
        }

        if ($request->closed_contest == '0') {
            $this->winner($contest->id);
        }
        $contest = $contest->update($data);

        if ($contest) {
            return redirect()->route('admin.contest.index')->with('info', __('done_update'));
        } else {
            return redirect()->back();
        }
    }

    public function winner($contest_id)
    {
        $contestUser = Contest::where('close_contest', '=', date('Y-m-d'))->first();
        if ($contestUser) {
            $all = ContestUser::where('contest_id', $contest_id)->get();
            foreach ($all as $one)
                if ($one->winner == 'true') {
                    $one->update(['winner' => 'false']);
                }
            $max = $one->max('count_like');
        }

        if ($max) {
            ContestUser::where('count_like', '=', $max)->update(['winner' => true]);
        }

    }

    public function Roles(Request $request)
    {
        $roles = [];

        $roles['image'] = 'required|sometimes|mimes:jpeg,png,jpg,gif';
        $roles['video'] = 'nullable';
        $roles['status'] = 'nullable|in:active,not_active';

        foreach (config('app.languages') as $locale => $lang) {
            $roles ["$locale.description"] = 'required|string';
        }

        $data = $this->validate($request, $roles);
    }

    public function getItems($req, $contest_id)
    {
        $contest = Contest::findOrFail($contest_id);

        if ($req === 'users') {
            $view = view('admin.contestAdmin.components.users', ['contest' => $contest])->render();
            return response()->json(['items' => $view]);
        }
        if ($req === 'home') {
            $view = view('admin.contestAdmin.components.home', ['contest' => $contest])->render();
            return response()->json(['items' => $view]);
        }
    }
}
