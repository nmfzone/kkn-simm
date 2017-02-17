<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Job;
use Datatables;

class JobsController extends Controller
{
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('jobs.manage');
        //
        // return view('jobs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('jobs.manage');
        //
        // return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $this->authorize('jobs.manage');

        $job = Job::create([
            'name' => $request->job_name,
        ]);

        alert()->success(trans('message.ctrl.jobs.store'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $this->authorize('jobs.manage');

        return view('settings.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\JobRequest  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, Job $job)
    {
        $this->authorize('jobs.manage');

        $job->update([
            'name' => $request->job_name,
        ]);

        alert()->success(trans('message.ctrl.jobs.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $this->authorize('jobs.manage');

        $job->delete();

        alert()->success(trans('message.ctrl.jobs.destroy'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Get all jobs by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJobs()
    {
        return Datatables::of(Job::all())
            ->addColumn('action', function ($job) {
                $action = '<a href="'. route('jobs.edit', $job) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('jobs.destroy', $job) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
