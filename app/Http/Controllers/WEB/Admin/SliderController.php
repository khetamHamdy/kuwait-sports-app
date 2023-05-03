<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Throwable;

class SliderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                if (can(['slider-show', 'slider-create', 'slider-edit', 'slider-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('slider-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('slider-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('slider-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->route('admin.home')->with('info', __('you dont have permeation'));        });
    }
    public function index(Request $request)
    {
        $params = $request->title;
        $dataSlider = Slider::filter($params)->latest()->paginate();

        return view('admin.sliders.home', compact('dataSlider'));
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
        return view('admin.sliders.create', compact('status'));
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
        $slider = Slider::create($data);

        if ($slider) {
            return redirect()->route('admin.slider.index')->with('success',  __('done_added'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public
    function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public
    function edit(Slider $slider)
    {
        $status = [
            'active' => 'Active', 'not_active' => 'Not Active'
        ];

        return view('admin.sliders.edit', compact('status', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function update(Request $request, Slider $slider)
    {
        $data = $request->all();
        $this->Roles($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->img($request, 'image');
        }

        $slider->update($data);

        if ($slider) {
            return redirect()->route('admin.slider.index')->with('info', __('done_update'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(Slider $slider)
    {
        if ($slider) {
            $slider->delete();
            return redirect()->route('admin.slider.index')->with('info',  __('done_deleted'));
        }
    }

    public function Roles(Request $request)
    {
        $roles = [];

        $roles['image'] = 'required|sometimes|mimes:jpeg,png,jpg,gif';
        $roles['link'] = 'required|url';
        $roles['status'] = 'nullable|in:active,not_active';

        foreach (config('app.languages') as $locale => $lang) {
            $roles ["$locale.title"] = 'required|string';
            $roles ["$locale.description"] = 'required|string';
        }
        $data = $this->validate($request, $roles);
    }

}
