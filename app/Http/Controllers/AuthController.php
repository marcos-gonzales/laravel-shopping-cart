<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function RegisterView()
    {
        return Inertia::render('Auth/Register');
    }

    public function Register()
    {
        $input = Request::validate([
            'name' => ['string', 'required'],
            'email' => ['email', 'required'],
            'password' => ['required', 'string'],
            'terms_of_service' => ['required', 'boolean'],
        ]);
        $user = User::create(array_merge($input, ['is_admin' => 0]));
        $user->update(['password' => bcrypt(Request::input('password'))]);

        return redirect()->route('auth.login')->with('success', 'Thanks for registering!');
    }

    public function LoginView()
    {
        return Inertia::render('Auth/Login');
    }
}
