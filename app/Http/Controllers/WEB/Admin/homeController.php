<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Exports\MessagesExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class homeController extends Controller
{
    public function index()
    {

        $event_count = Event::count();
        $product_count = Product::count();
        $user_count = User::count();
        $admin_count = Admin::count();

        return view('admin.home.dashboard', compact('event_count', 'product_count', 'user_count', 'admin_count'));
    }

    public function contact_users(Request $request)
    {
        $contact = Contact::filter($request)->latest()->paginate();

        return view('admin.contact.home', compact('contact'));
    }

    public function favorites()
    {
        $fav = Event::latest()->paginate();
        // return Favorite::withCount('event')->where('event_id' ,6)->count();
        return view('admin.favorite.home', compact('fav'));
    }

    public function changeStatus($model, Request $request)
    {
        $role = "";
        if ($model == "admins") $role = 'App\Models\Admin';
        if ($model == "event") $role = 'App\Models\Event';
        if ($model == "product") $role = 'App\Models\Product';
        if ($model == "slider") $role = 'App\Models\Slider';
        if ($model == "user") $role = 'App\Models\User';
        if ($model == "roles") $role = 'App\Models\Role';
        if ($model == "contact_users") $role = 'App\Models\Contact';
        if ($model == "newsletter") $role = 'App\Models\Subscribe';
        if ($model == "poster") $role = 'App\Models\Posters';
        if ($model == "permission") $role = 'App\Models\Permission';
        if ($model == "contest") $role = 'App\Models\Contest';
        if ($model == "users_contest_participants") $role = 'App\Models\ContestUser';
        if ($model == "media") $role = 'App\Models\Media';
        if ($role != "") {
            if ($request->action == 'delete') {
                $role::query()->whereIn('id', $request->IDsArray)->delete();
            } else {
                if ($request->action) {
                    $role::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->action]);
                }
            }

            return $request->action;
        }
        return false;
    }

    public function export_message(Request $request)
    {
        return Excel::download(new MessagesExport(), 'Messages.xlsx');
    }
}
