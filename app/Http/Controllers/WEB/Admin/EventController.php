<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Throwable;

class EventController extends Controller
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
                if (can(['event-show', 'event-create', 'event-edit', 'event-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('event-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('event-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('event-delete')) {
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

        $dataEvent = Event::filter($request)->latest()->paginate(8);
        $type = ['blog' => 'Blog', 'featured' => 'Featured', 'location' => 'Location',
            'interviews' => 'Interviews', 'advice' => 'Advice', 'food' => 'Food'
        ];

        return view('admin.events.home', compact('dataEvent', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = [
            'active' => 'Active', 'not_active' => 'Not Active'
        ];

        $type = ['blog' => 'Blog', 'featured' => 'Featured', 'location' => 'Location',
            'interviews' => 'Interviews', 'advice' => 'Advice', 'food' => 'Food'
        ];
        return view('admin.events.create', compact('type', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $this->Roles($request);

            $event = new Event();
            if ($request->hasFile('video')) {
                $data['video'] = $this->img($request, 'video');
            }

//            if ($request->hasFile('image')) {
//                $data['image'] = $this->storeImage($request->file('image'),
//                    'events', $event->getRawOriginal('image'), 442, 614);
//            }

            if ($request->hasFile('image')) {
                $data['image'] = $this->img($request, 'image');
            }

            $event = Event::create($data);

            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = 'uploads/';
                    $image_url = $upload_path . $image_full_name;
                    $file->move($upload_path, $image_full_name);

                    $event->eventImages()->create(
                        ['event_id' => $event->id, 'image' => $image_url]);
                }
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        if ($event) {
            return redirect()->route('admin.event.index')->with('success', __('done_added'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public
    function show(Event $event)
    {
        $all = $event->images;
        $images = explode(' | ', $all);
        return view('admin.events.show', compact('event', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Event $event)
    {
        $status = [
            'active' => 'Active', 'not_active' => 'Not Active'
        ];
        $type = ['blog' => 'Blog', 'featured' => 'Featured', 'location' => 'Location', 'interviews' => 'Interviews',
            'advice' => 'Advice', 'food' => 'Food'];

        return view('admin.events.edit', compact('type', 'status', 'event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function update(Request $request, Event $event)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $this->Roles($request);

            if ($request->hasFile('video')) {
                $data['video'] = $this->img($request, 'video');
            }

            if ($request->hasFile('image')) {
                $data['image'] = $this->img($request, 'image');
            }

            $event->update($data);

            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name . '.' . $ext;
                    $upload_path = 'uploads/';
                    $image_url = $upload_path . $image_full_name;
                    $file->move($upload_path, $image_full_name);

                    $event->eventImages()->create(
                        ['event_id' => $event->id, 'image' => $image_url]);
                }
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        if ($event) {
            return redirect()->route('admin.event.index')->with('info', __('done_update'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy(Event $event)
    {
        if ($event) {
            $event->delete();
            return redirect()->route('admin.event.index')->with('info', __('done_deleted'));
        }
    }

    public function Roles(Request $request)
    {
        $roles = [];

        $roles['image'] = 'required | sometimes | mimes:jpeg,png,jpg,gif';
        $roles['video'] = 'nullable | sometimes';
        $roles ['type'] = 'required | string | in:blog,featured,location,interviews,advice,food';
        $roles['link'] = 'required | url';
        $roles['status'] = 'nullable | in:active,not_active';

        foreach (config('app.languages') as $locale => $lang) {
            $roles ["$locale.title"] = 'required | string';
            $roles ["$locale.description"] = 'nullable | string';
        }
        $data = $this->validate($request, $roles);
    }

    public function getItems($req, $event_id)
    {
        $event = Event::findOrFail($event_id);

        if ($req === 'image') {
            $view = view('admin.events.components.images', ['event' => $event])->render();
            return response()->json(['items' => $view]);
        }
        if ($req === 'home') {
            $view = view('admin.events.components.home', ['event' => $event])->render();
            return response()->json(['items' => $view]);
        }
    }

    public function deleteEventImage($event_image_id)
    {
        $eventImage = EventImage::findOrFail($event_image_id);
        $eventImage->delete();
        return response()->json(['message' => 'Event Image Deleted']);
    }
}
