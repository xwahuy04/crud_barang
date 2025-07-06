<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisiorController extends Controller
{
    public function index()
    {
        return view('supervisior.dashboard', [
            'title' => 'Dashboard Supervisor'
        ]);
    }


}
