<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home')->with('success','Anda Berhasil Masuk!');;
        }

        return back()->with('fail', 'Email atau Password anda Salah!');   
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success', 'Anda Berhasil Keluar!');
    }

}
