<?php

namespace App\Http\Controllers\WEB\Site;

use App\Http\Controllers\Controller;
use App\Http\Traits\imageTrait;
use App\Models\Contact;
use App\Models\Contest;
use App\Models\ContestAdminLikes;
use App\Models\ContestUser;
use App\Models\Event;
use App\Models\EventLikes;
use App\Models\Favorite;
use App\Models\Media;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use App\Models\UserLikes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    use imageTrait;

    public function index()
    {
        $event_featured = Event::status()->with('users')->where('type', 'featured')->latest()->take(5)->get();
        $event_blog = Event::status()->with('users')->where('type', '=', 'blog')->latest()->take(5)->get();
        $event_location = Event::status()->with('users')->where('type', 'location')->latest()->take(5)->get();
        $event_interview1 = Event::status()->where('type', 'interviews')->first();
        $event_interview2 = Event::status()->with('users')->where('type', 'interviews')->latest()->take(2)->get();
        $event_advice = Event::status()->with('users')->where('type', 'advice')->latest()->take(5)->get();
        $topcContestUser = ContestUser::status()->take(10)->orderBy('count_like', 'DESC')->get();

        $contest = Contest::all();

        $productSetting = Setting::first();

        return view('website.home', compact('contest', 'event_advice', 'event_blog', 'event_featured',
            'event_interview1', 'event_interview2', 'event_location', 'productSetting', 'topcContestUser'));
    }

    public function event()
    {
        $event_first = Event::status()->first()->description;
        $event = Event::status()->where('type', '!=', 'food')->latest()->get();
        return view('website.events', compact('event', 'event_first'));
    }

    public function products()
    {
        $products = Product::status()->latest()->get();
        return view('website.products', compact('products'));
    }


    public function about()
    {
        return view('website.about');
    }

    public function blogs()
    {
        $event = Event::status()->where('type', '=', 'blog')->get();
        return view('website.blogs', compact('event'));
    }

    public function advice()
    {
        $event = Event::status()->where('type', '=', 'advice')->get();
        return view('website.advice', compact('event'));
    }

    public function Interviews()
    {
        $event = Event::status()->where('type', '=', 'Interviews')->get();
        return view('website.interviews', compact('event'));
    }

    public function photoContestUsers()
    {
          $contest_user = ContestUser::status()->latest()->get();
        $all_contest = Contest::status()->latest()->get();

        return view('website.photo_contest', compact('all_contest' ,'contest_user'));
    }

    public function photoMedia()
    {
        $media = Media::status()->latest()->get();
        // return $cntest;
        return view('website.media', compact('media'));
    }

    public function terms_condition()
    {
        return view('website.Terms');
    }

    public function privacyPolicy()
    {
        return view('website.privacy_policy');
    }

    public function food()
    {
        $food = Event::status()->where('type', 'food')->get();
        return view('website.food', compact('food'));
    }

    public function editProfile()
    {
        $user = Auth::guard('web')->user();
        return view('auth.editProfile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::guard('web')->id();
        $user = User::where('id', $id)->first();

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($request->hasFile('image')) {
                $name = time() . "_" . rand(10000, 99999) . "." . $request->file('image')
                        ->getClientOriginalExtension();
                $request->file('image')->move("uploads/", $name);
            }
            $data['image'] = 'uploads/' . $name;
        }

        $user->update($data);
        return redirect()->back()->with("info", __('done_update'));
    }

    public function editPassword()
    {
        $user = Auth::guard('web')->user();
        return view('auth.editPassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $id = Auth::guard('web')->id();
        $user = User::where('id', $id)->first();

        $request->validate([
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);
        $done = $user->update(['password' => Hash::make($request->password)]);
        if ($done) {
            return redirect()->back()->with("info", __('done_update'));
        }
    }

    public function contact_create()
    {
        return view('website.contact');
    }

    public function contact_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->mobile = $request->mobile;
        $contact->messages = $request->message;
        $contact->save();
        if ($contact) {
            return response()->json(
                [
                    'success' => true,
                    'message' => __('done_added')
                ]
            );
        }
    }

    public function details_event(Event $event)
    {
        return view('website.detailsEvent', compact('event'));
    }

    public function details_product(Product $product)
    {
        return view('website.detailsProduct', compact('product'));
    }

    public function search_event(Request $request)
    {
        $params = $request->get('search');
        $event = Event::search($params)->latest()->get();


        if ($event->count() == 0) {
            return redirect()->route('home')->with('info', __('Unfortunately it is not found in the search list! search again'));
        }
        return view('website.serach', compact('event'));
    }

    public function favorite_users(Request $request, $event_id, $user_id = 5)
    {
        if (!Auth::check()) {
            return response()->json([
                'messages' => __('Login')
            ]);
        }
        $event = EventLikes::where('user_id', $user_id)->where('event_id', $event_id)->first();
        if ($event) {
            $event->delete();
            Event::where('id', '=', $event_id)->update(['count_like' => DB::raw('count_like - ' . 1)]);
            return response()->json([
                'bool' => false
            ]);
        }
        if (!$event) {
            EventLikes::create([
                'event_id' => $event_id,
                'user_id' => $user_id
            ]);

            Event::where('id', '=', $event_id)->update(['count_like' => DB::raw('count_like + ' . 1)]);
            return response()->json([
                'bool' => true
            ]);
        } else {
            return response()->json([
                'bool' => false
            ]);
        }
    }

    public function favorite_admin(Request $request, $contest_id, $user_id = 2)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $contest = ContestAdminLikes::where('user_id', $user_id)->where('contest_id', $contest_id)->first();
        if ($contest) {
            $contest->delete();
            Contest::where('id', '=', $contest_id)->update(['count_like' => DB::raw('count_like - ' . 1)]);
            return response()->json([
                'messages' => "update"
            ]);
        }
        if (!$contest) {
            ContestAdminLikes::create([
                'contest_id' => $contest_id,
                'user_id' => $user_id
            ]);

            Contest::where('id', '=', $contest_id)->update(['count_like' => DB::raw('count_like + ' . 1)]);
            return response()->json([
                'bool' => true
            ]);
        } else {
            return response()->json([
                'bool' => false
            ]);
        }
    }

    public function favorite_contest(Request $request, $contest_id, $user_id = 2)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = UserLikes::where('user_id', $user_id)->where('contest_id', $contest_id)->first();
        if ($user) {
            $user->delete();
            ContestUser::where('id', '=', $contest_id)->update(['count_like' => DB::raw('count_like - ' . 1)]);
            return response()->json([
                'messages' => "update"
            ]);
        }
        if (!$user) {
            UserLikes::create([
                'contest_id' => $contest_id,
                'user_id' => $user_id
            ]);

            ContestUser::where('id', '=', $contest_id)->update(['count_like' => DB::raw('count_like + ' . 1)]);
            return response()->json([
                'bool' => true
            ]);
        } else {
            return response()->json([
                'bool' => false
            ]);
        }
    }

    public function event_more($type)
    {
        $event = Event::where('type', '=', $type)->get();
        return view('website.moreEvent', compact('event'));
    }

    public function contest_create()
    {
        $contest = Contest::where('status', 'active')->latest()->first();
        return view('website.contest', compact('contest'));
    }

    public function contest_store(Request $request)
    {
        $id = Auth::guard('web')->id();
        $data = $request->all();

        $contest_user = ContestUser::where('user_id', $id)->where('contest_id', $request->post('contest_id'))->first();

        $request->validate([
            'image' => 'required|image',
            'description' => 'required|string|max:255|min:3'
        ]);

        if (!$contest_user) {
            if ($request->hasFile('image')) {
                $data['image'] = $this->img($request, 'image');
            }
            $data['user_id'] = $id;

            ContestUser::create($data);
            return redirect()->route('photo-contest-user')->with('success', __('done_added'));

        } else {
            return redirect()->route('photo-contest-user')->with('info', __('You are not allowed to register because you have already registered'));

        }
    }
}
