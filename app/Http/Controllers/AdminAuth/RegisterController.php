<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'numeric', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ]);

        $data['password'] = Hash::make($request->password);
        $Admin = Admin::create($data);

        event(new Registered($Admin));

        Auth::login($Admin);

        return redirect(RouteServiceProvider::HOME_admin);
    }
}
