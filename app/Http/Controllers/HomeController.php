<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            return redirect()
                ->route('dashboard.profiles.show', auth()->user()->profiles()->first())
                ->with('verified', session('verified'));
        }

        return view('welcome');
    }
}
