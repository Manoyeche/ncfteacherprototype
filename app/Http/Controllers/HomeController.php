<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin');
        }
        if (auth()->user()->isTeacher()) {
            return redirect()->route('teacher');
        }
        if (auth()->user()->isStudent()) {
            return redirect()->route('student');
        }

        return abort(500);
    }
}
