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
        $educationAll = $this->buildPagination('education', Education::all());
        $jobs = $this->buildPagination('job', Job::all());
        $disabilities = $this->buildPagination('disability', Disability::all());

        return view('home', compact('educationAll', 'jobs', 'disabilities'));
    }

    public function buildPagination($name, $data, $perPage = 5, $baseRoute = null)
    {
        $data = paginate($data, $perPage, $name, $baseRoute
            ? route('dashboard.index')
            : $baseRoute
        );

        $appends = collect([
            'education', 'job', 'disability',
        ]);

        $appends->each(function($append) use (&$data, $name) {
            if ($append != $name) {
                $data->appends($append, RequestFacade::get($append, 1));
            }
        });

        return $data;
    }
}
