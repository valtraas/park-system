<?php

namespace App\Http\Controllers;

use App\Models\loginActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('landing.auth', [
            'title' => 'Parking | Login'
        ]);
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            loginActivity::create([
                'user_id' => Auth::user()->id,
                'login' => Carbon::now(),
            ]);
            notify()->emotify('success', 'Selamat datang ' . Auth::user()->username);
            return redirect()->route('home');
        }
        notify()->error('Periksa username dan password', 'Login Gagal');
        return back();
    }


    public function logout(Request $request)
    {
        $userLogin = loginActivity::where('user_id',Auth::user()->id)->latest()->get();
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $userLogin->each(function ($activity) {
            $activity->update(['logout' => Carbon::now()]);
        });;

        return redirect()->route('home');
    }
}
