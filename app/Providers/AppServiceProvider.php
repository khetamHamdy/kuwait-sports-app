<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Event;
use App\Models\Favorite;
use App\Models\Posters;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Subscribe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('poster', Posters::status()->inRandomOrder()->first());

        View::share('poster820', Posters::where('type','side820')->status()->inRandomOrder()->first());
        View::share('poster535', Posters::where('type','side535')->status()->inRandomOrder()->first());
        View::share('poster450', Posters::where('type','side450')->status()->inRandomOrder()->first());
        View::share('poster_above', Posters::where('type','above')->status()->inRandomOrder()->first());

        View::share('setting', Setting::latest()->first());
        View::share('event_title', Event::status()->latest()->take(10)->get());
        View::share('silder', Slider::status()->latest()->get());
        View::share('contacts_count', Contact::latest()->count());
        View::share('subscribe_count', Subscribe::status()->latest()->count());
        View::share('event_advice', Event::status()->latest()->where('type', '=', 'advice')->take(10)->get());
//        view()->composer('*', function ($view) {
//            $view->with('Favorite', Favorite::where('user_id', '=', Auth::guard('web')->id())->get());
//            $view->with('cartCount', Cart::where('user_id', '=', Auth::guard('web')->id())->count());
//
//        });
    }
}
