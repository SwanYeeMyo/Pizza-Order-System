<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //direct login page
    public function loginPage()
    {
        return view('login');
    }
    // direct register page
    public function registerPage()
    {
        return view('register');
    }
    public function home()
    {
        return view('user.home');
    }
    //direct dashboard
    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        }
        return \redirect()->route('user#home');
    }

}
