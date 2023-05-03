<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class MediaController extends Controller
{
    use imageTrait;

    public function __construct()
    {
        $route = Route::currentRouteAction();
        $route_name = substr($route, strpos($route, "@") + 1);
        $this->middleware(function ($request, $next) use ($route_name) {

            if ($route_name == 'index') {
                if (can(['media-show', 'media-create', 'media-edit', 'media-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('media-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('media-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('media-delete')) {
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
//  return media::with('user')->get();
        //return media::with('users')->get();
//        $mediaUser = mediaUser::whereMonth('created_at', '=', date('m'))->max('count_like');

//        $params = $request->status;
//        $datamedia = mediaUser::filter($params)->latest()->paginate();
        $params = $request->status;
        $datamedia = Media::filter($params)->latest()->paginate(10);
        return view('admin.media.home', compact('datamedia'));
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
        return view('admin.media.create', compact('status'));
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

        $media = Media::create($data);

        if ($media) {
            return redirect()->route('admin.media.index')->with('success', __('done_added'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\media $media
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Media $medium)
    {
        return view('admin.media.show', compact('medium'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\media $media
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(media $medium)
    {
        $status = [
            'active' => 'Active', 'not_active' => 'Not Active'
        ];
        return view('admin.media.edit', compact('medium', 'status'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\media $media
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Media $medium)
    {
        $data = $request->all();

        $this->Roles($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->img($request, 'image');
        }

        if ($request->hasFile('video')) {
            $data['video'] = $this->img($request, 'video');
        }

        $media = $medium->update($data);

        if ($media) {
            return redirect()->route('admin.media.index')->with('info', __('done_update'));
        } else {
            return redirect()->back();
        }
    }


    public function Roles(Request $request)
    {
        $roles = [];

        $roles['image'] = 'required|sometimes|mimes:jpeg,png,jpg,gif';
        $roles['video'] = 'nullable';
        $roles['status'] = 'nullable|in:active,not_active';

        $data = $this->validate($request, $roles);
    }

    public function getItems($req, $media_id)
    {
        $media = media::findOrFail($media_id);

        if ($req === 'users') {
            $view = view('admin.media.components.users', ['media' => $media])->render();
            return response()->json(['items' => $view]);
        }
        if ($req === 'home') {
            $view = view('admin.media.components.home', ['media' => $media])->render();
            return response()->json(['items' => $view]);
        }
    }
}
