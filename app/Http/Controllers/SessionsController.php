<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
{
    $attributes = request()->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($attributes)) {
        session()->regenerate();

        $user = Auth::user(); 
        switch ($user->userType) {
            case 'Administrador':
                return redirect('/dashboard');
            case 'Cliente':
                return redirect('/shop');
            case 'Trabajador':
                return redirect('/dashboard');
            default:
                return redirect('/dashboard');
        }
    } else {
        return back()->withErrors(['email' => 'Email or password invalid.']);
    }
}

    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
