<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SettingsController extends Controller
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
                if (can(['settings-show', 'settings-create', 'settings-edit', 'settings-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('settings-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('settings-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('settings-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->route('admin.home')->with('info', __('you dont have permeation'));
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $setting = Setting::where('id', 1)->first();
        $product = Product::latest()->get();
        return view('admin.settings.edit', compact('setting', 'product'));
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
        if ($request->hasFile('primaryLogo')) {
            $data['primaryLogo'] = $this->img($request, 'primaryLogo');
        }
        if ($request->hasFile('secondaryLogo')) {
            $data['secondaryLogo'] = $this->img($request, 'secondaryLogo');
        }
        if ($request->hasFile('service_image1')) {
            $data['service_image1'] = $this->img($request, 'service_image1');
        }
        if ($request->hasFile('service_image2')) {
            $data['service_image2'] = $this->img($request, 'service_image2');
        }
        if ($request->hasFile('service_image3')) {
            $data['service_image3'] = $this->img($request, 'service_image3');
        }
        if ($request->hasFile('fav_icon')) {
            $data['fav_icon'] = $this->img($request, 'fav_icon');
        }
        if ($request->hasFile('image_web_all')) {
            $data['image_web_all'] = $this->img($request, 'image_web_all');
        }
        $settings = Setting::updateOrCreate(
            ['id' => 1],
            $data
        );

        return redirect()->back()->with('info', __('done_update'));
    }


}
