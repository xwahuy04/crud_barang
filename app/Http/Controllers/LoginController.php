<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $user = User::where('email', '=', $request->email)->first();
    
    if($user){
        if(Hash::check($request->password, $user->password)){
            $request->session()->put('loginId', $user->id);
            $request->session()->put('userRole', $user->role); 
            $request->session()->put('userName', $user->name); 
            
             if($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif($user->role === 'supervisor') {
                return redirect()->route('supervisor.dashboard');
            }
            
            return back()->with('error', 'Role tidak dikenali');
        } else {
            return back()->with('error', 'Password tidak sesuai!');
        }
    } else {
        return back()->with('error', 'Email tidak terdaftar.');
    }
}

   public function logout(Request $request)
{
    if (Session::has('loginId')) {
        Session::pull('loginId');
        return redirect('/')->with('success', 'You have successfully logged out.');
    } else {
        return redirect('/')->with('error', 'You are not logged in.');

    }
}
}
