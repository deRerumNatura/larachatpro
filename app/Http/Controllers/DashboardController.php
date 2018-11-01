<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return auth()->user()->admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
}
