<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Posters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Route;

class PostersController extends Controller
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
                if (can(['posters-show', 'posters-create', 'posters-edit', 'posters-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('posters-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('posters-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('posters-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->route('admin.home')->with('info', __('you dont have permeation'));
        });
    }

    public function index(Request $request)
    {
        $poster = Posters::latest()->paginate();
        return view('admin.poster.home', compact('poster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $type = ['side820' => 'Side 1  ,height 820', 'side535' => 'Side 2 ,height 535', 'side450' => 'Side 3 ,height 450', 'above' => 'Above'];
        return view('admin.poster.create', compact('type'));
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

        if ($request->type == 'side820') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->storeImage($request->file("image"), 'image', '', 261, 820);
            }
        }

        if ($request->type == 'side535') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->storeImage($request->file("image"), 'image', '', 261, 535);
            }
        }

        if ($request->type == 'side450') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->storeImage($request->file("image"), 'image', '', 261, 450);
            }
        }

        if ($request->type == 'above') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->storeImage($request->file("image"), 'image', '', 1116, 100);
            }
        }

        $img_public = Posters::create($data);

        if ($img_public) {
            return redirect()->route('admin.poster.index')->with('success', __('done_added'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Posters $posters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public
    function show(Posters $poster)
    {
        return view('admin.poster.show', compact('poster'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Posters $poster
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Posters $poster)
    {
        $type = ['side820' => 'Side 1  ,height 820', 'side535' => 'Side 2 ,height 535', 'side450' => 'Side 3 ,height 450', 'above' => 'Above'];
        return view('admin.poster.edit', compact('poster', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Posters $poster
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Posters $poster)
    {
        $data = $request->all();
        $this->Roles($request);


        if ($request->type == 'side820') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->storeImage($request->file("image"), 'image', '', 261, 820);
            }
        }

        if ($request->type == 'side535') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->storeImage($request->file("image"), 'image', '', 261, 535);
            }
        }

        if ($request->type == 'side450') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->storeImage($request->file("image"), 'image', '', 261, 450);
            }
        }

        if ($request->type == 'above') {
            if ($request->hasFile('image')) {
                $data['image'] = $this->storeImage($request->file("image"), 'image', '', 1116, 100);
            }
        }

        $poster->update($data);

        if ($poster) {
            return redirect()->route('admin.poster.index')->with('success', __('done_update'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Posters $poster
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(Posters $poster)
    {
        if ($poster) {
            $poster->delete();
            return redirect()->route('admin.poster.index')->with('info', __('done_deleted'));
        }
    }

    public function Roles(Request $request)
    {
        $roles = [];

        $roles['image'] = 'required|sometimes|mimes:jpeg,png,jpg,gif';
        $roles['link'] = 'required|url';

        $data = $this->validate($request, $roles);
    }


}
