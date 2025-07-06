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
        $users = User::all();
        return view('admin.dashboard', compact('users'));
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('user')->with('success', 'User created successfully');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user')->with('success', 'User deleted successfully');
    }

}
