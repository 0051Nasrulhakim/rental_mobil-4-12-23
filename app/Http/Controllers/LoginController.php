<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.home');
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $request->session()->put('user_id', Auth::user()->id);
            $request->session()->put('nama', Auth::user()->nama);
            $request->session()->put('alamat', Auth::user()->alamat);
            $request->session()->put('nomor_telfon', Auth::user()->nomor_telfon);
            $request->session()->put('nomor_sim', Auth::user()->nomor_sim);
            $request->session()->put('email', Auth::user()->email);
            // session(['user_id' => $user->id, 'user_name' => $user->name]);
            // session()->save();
            // return redirect()->intended('dashboard.home');
            return redirect()->route('dashboard.home');
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}