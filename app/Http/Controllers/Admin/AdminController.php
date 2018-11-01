<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard')->with('users', User::where('id', '!=', auth()->user()->id)->get());
    }

    public function store(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $user->disabled = (int)$request->disabled;
        $user->baned = (int)$request->baned;

        $user->save();

        return redirect()->route('admin.dashboard');
    }
}
