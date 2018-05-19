<?php

namespace App\Http\Controllers;

use App\Traits\ModelFinder;
use App\WorkDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    use ModelFinder;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('home', 'settings');
        $this->middleware('auth.admin')->only('dashboard', 'settings');
    }

    /**
     * Show the application index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        // $profile = \App\Profile::first()->workdays()->where('work_day_id', 6)->first();
        $profile = \App\WorkDay::find(6)->profiles()->where('profile_id', 1)->first();


        $profiles = WorkDay::profilesOnDuty(5, 15, 24);

        return view('home', compact('profiles'));
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the admin account settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        return view('admin.settings.edit')->with([
            'user' => Auth::user(),
            'roles' => ''
        ]);
    }
}
