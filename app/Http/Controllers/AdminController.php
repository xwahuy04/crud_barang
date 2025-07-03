<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function user()
    {
        // Pastikan user sudah login via session
        if (!Session::has('loginId')) {
            return redirect('/')->with('fail', 'Anda harus login terlebih dahulu');
        }
        
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($user) {
            return redirect()->route('user')->with('success', 'User berhasil ditambahkan');
        } else {
            return back()->with('fail', 'Gagal menambahkan user');
        }
    } catch (\Exception $e) {
        return back()->with('fail', 'Error: '.$e->getMessage());
    }
}
}
