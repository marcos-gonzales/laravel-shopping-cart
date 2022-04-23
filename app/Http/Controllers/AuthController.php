<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function RegisterView()
    {
        return Inertia::render('Auth/Register');
    }
}
