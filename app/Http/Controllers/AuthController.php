<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function RegisterView()
    {
        return Inertia::render('Auth/Register');
    }

    public function Register()
    {
        $existingUser = User::where('email', Request::input('email'))->first();
        if(!$existingUser) {
            $input = Request::validate([
                'name' => ['string', 'required'],
                'email' => ['email', 'required'],
                'password' => ['required', 'string'],
                'terms_of_service' => ['required', 'boolean'],
            ]);

            $user = User::create(array_merge($input, ['is_admin' => 0]));
            $user->update(['password' => bcrypt(Request::input('password'))]);
            $user->createAsStripeCustomer();

            Auth::login($user);
            $data = ['user' => $user];
            Mail::to($user->email)->send(new WelcomeEmail($data));

            return redirect()->to('/')->with('success', 'Thanks for registering!');

        } else {
            return redirect()->route('auth.login')->with('error', 'There is already an account with this email.');
        }

    }

    public function LoginView()
    {
        return Inertia::render('Auth/Login');
    }

    public function login()
    {
        $input = Request::validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        if (Auth::attempt($input)) {
            Request::session()->regenerate();
            return redirect()->to('/')->with('success', 'You have successfully logged in.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function Logout()
    {
        Auth::logout();
        Request::session()->invalidate();
        Request::session()->regenerateToken();
        return redirect('/')->with('success', 'you have logged out.');
    }
}
