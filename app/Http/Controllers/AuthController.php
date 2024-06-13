<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display authentication login page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('content.authentication.login');
    }

    /**
     * Display authentication register page.
     *
     * @return \Illuminate\View\View
     */
    public function register() {
        return view('content.authentication.register');
    }

    public function login(Request $request) {
        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
}
