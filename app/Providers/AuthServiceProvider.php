<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Contest;
use App\Policies\ContestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerPolicies();
//        Passport::routes();
//        Gate::before(function ($admin, $ability) {
//            if ($admin->id == 1) {
//                return true;
//            }
//        });
//
//        foreach (config('abilities') as $ability => $label) {
//            Gate::define($ability, function ($admin) use ($ability) {
//                return $admin->hasAbility($ability);
//            });
//        }
    }
}
