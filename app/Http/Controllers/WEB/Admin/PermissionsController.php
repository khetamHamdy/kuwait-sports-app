<?php

namespace App\Http\Controllers\WEB\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Response;
use Intervention\Image\Facades\Image;
use App\Models\Setting;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

class PermissionsController extends Controller
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
//            if (can('permissions')) {
//                return $next($request);
//            }
            if ($route_name == 'index') {
                if (can(['permissions-show', 'permissions-create', 'permissions-edit', 'permissions-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('permissions-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('permissions-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('permissions-delete')) {
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
        $items = Permission::latest()->paginate(30);

        return view('admin.permissions.home', [
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
        return view('admin.permissions.create', [
            'permissions' => $permissions,
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
        $permissions = [];

        $this->validate($request, $permissions);

        $slug = strtolower(str_replace('-', ' ', $request->name_en));

        if ($request->show) {
            $item_show = new Permission();
            $item_show->translateOrNew('ar')->name = ' عرض ' . $request->name_ar;
            $item_show->translateOrNew('en')->name = ' Show ' . $request->name_en;
            $item_show->slug = $slug . '-show';
            $item_show->save();
        }
        if ($request->create) {
            $item_create = new Permission();
            $item_create->translateOrNew('ar')->name = ' اضافة ' . $request->name_ar;
            $item_create->translateOrNew('en')->name = ' Create ' . $request->name_en;
            $item_create->slug = $slug . '-create';
            $item_create->save();
        }
        if ($request->edit) {
            $item_edit = new Permission();
            $item_edit->translateOrNew('ar')->name = ' تعديل ' . $request->name_ar;
            $item_edit->translateOrNew('en')->name = ' Edit ' . $request->name_en;
            $item_edit->slug = $slug . '-edit';
            $item_edit->save();
        }
        if ($request->delete) {
            $item_delete = new Permission();
            $item_delete->translateOrNew('ar')->name = ' حذف ' . $request->name_ar;
            $item_delete->translateOrNew('en')->name = ' Delete ' . $request->name_en;
            $item_delete->slug = $slug . '-delete';
            $item_delete->save();
        }

        return redirect()->route('admin.permission.index')->with('success',  __('done_added'));

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
        $item = Permission::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Permission::findOrFail($id);
        return view('admin.permissions.edit', [
            'item' => $item,
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

        $permissions = [];
        $locales = config('app.languages');
        foreach ($locales as $locale => $key) {
            $permissions['name_' . $locale] = 'required';
        }
        $this->validate($request, $permissions);


        $item = Permission::query()->findOrFail($id);

        foreach ($locales as $locale => $key) {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        $item->slug = $request->slug;
        $item->save();

        return redirect()->back()->with('success', __('done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePermission(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            DB::table("permissions")->whereIn('id', explode(",", $ids))->delete();
            return response()->json(['success' =>  __('done_deleted'), 'id' => $ids]);
        }

    }
}
