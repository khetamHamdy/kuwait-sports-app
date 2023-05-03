<?php


namespace App\Http\Controllers\WEB\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Response;

use Image;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Category;
use App\Models\SubDepartment;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Route;
use Throwable;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $route = Route::currentRouteAction();
        $route_name = substr($route, strpos($route, "@") + 1);
        $this->middleware(function ($request, $next) use ($route_name) {
            if (can('roles')) {
                return $next($request);
            }
            if ($route_name == 'index') {
                if (can(['roles-show', 'roles-create', 'roles-edit', 'roles-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('roles-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('roles-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('roles-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->route('admin.home')->with('info', __('you dont have permeation'));
        });
    }

    public function index()
    {
        $items = Role::orderBy('id', 'desc')->paginate(30);

        return view('admin.roles.home', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('admin.roles.create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        DB::beginTransaction();
//        try {
        $roles = [
            'permissions' => 'required',
        ];
        foreach (config('app.languages') as $key => $lang) {
            $roles['name_' . $key] = 'required';
        }
        $this->validate($request, $roles);

        $item = new Role();

        foreach (config('app.languages') as $key => $lang) {
            $item->translateOrNew($key)->name = $request->get('name_' . $key);
        }

        $item->save();

        if ($request->permissions != null) {
            foreach ($request->permissions as $permission) {
                $values[] = [
                    'role_id' => $item->id,
                    'permission_id' => $permission,
                ];
            }
            RolePermission::insert($values);
        }

        return redirect()->route('admin.roles.index')->with('success', __('done_added'));
//        } catch (Throwable $e) {
//            DB::rollBack();
//            throw $e;
//        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = Role::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $permissions = Permission::get();
        $item = Role::with('permissions')->findOrFail($id);
        return view('admin.roles.edit', [
            'item' => $item,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $roles = [
            'permissions' => 'required',
        ];

        $locales = config('app.languages');
        foreach ($locales as $locale => $key) {
            $roles['name_' . $locale] = 'required';
        }
        $this->validate($request, $roles);


        $item = Role::query()->findOrFail($id);

        foreach ($locales as $locale => $key) {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        $item->save();

        if ($request->permissions != null) {
            foreach ($request->permissions as $permission) {
                $values[] = [
                    'role_id' => $item->id,
                    'permission_id' => $permission,

                ];
            }
            RolePermission::where('role_id', $item->id)->delete();
            RolePermission::insert($values);

        }
        return redirect()->route('admin.roles.index')->with('info', __('done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */
    public function destroy($id)
    {

        $item = Role::query()->findOrFail($id);
        if ($item) {
            Role::query()->where('id', $id)->delete();

            return "success";
        }
        return "fail";
    }
}
