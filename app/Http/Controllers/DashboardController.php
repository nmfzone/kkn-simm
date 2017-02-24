<?php

namespace App\Http\Controllers;

use App\Disability;
use App\Education;
use App\Job;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

class DashboardController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educationAll = Education::all();
        $jobs = Job::all();
        $disabilities = Disability::all();

        return view('home', compact('educationAll', 'jobs', 'disabilities'));
    }
}
