<?php

namespace Beh7ad\User\Http\Controllers\Auth;

use Illuminate\View\View;
use Beh7ad\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Beh7ad\User\Rules\ValidMobile;
use App\Http\Controllers\Controller;
use Beh7ad\User\Rules\ValidPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('User::Front.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['nullable', 'string', 'min:10' ,'max:10', 'unique:'.User::class , new ValidMobile],
            'password' => ['required', 'confirmed', Rules\Password::defaults() , new ValidPassword],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
