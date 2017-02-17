<?php

namespace App\Http\Controllers;

use App\Disability;
use App\Education;
use App\Http\Requests\ResidentRequest;
use App\Job;
use App\Resident;
use App\Setting;
use Carbon\Carbon;
use Datatables;

class ResidentsController extends Controller
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
        $this->authorize('residents.manage');

        return view('residents.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menLists()
    {
        $this->authorize('residents.manage');

        return view('residents.men_lists');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function womenLists()
    {
        $this->authorize('residents.manage');

        return view('residents.women_lists');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPartition($partition)
    {
        $this->authorize('residents.manage');

        return view('residents.show_partition', compact('partition'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('residents.manage');

        return view('residents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ResidentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResidentRequest $request)
    {
        $this->authorize('residents.manage');

        $request->merge([
            'date_of_birth' => Carbon::parse($request->date_of_birth)->startOfDay(),
        ]);

        $resident = Resident::create($request->all());
        $resident->disabilities()->sync($request->disability ?: []);

        alert()->success(trans('message.ctrl.residents.store'))->persistent("Close");

        return redirect(route('residents.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(Resident $resident)
    {
        $this->authorize('residents.manage');

        return view('residents.show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit(Resident $resident)
    {
        $this->authorize('residents.manage');

        return view('residents.edit', compact('resident'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ResidentRequest  $request
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(ResidentRequest $request, Resident $resident)
    {
        $this->authorize('residents.manage');

        $request->merge([
            'date_of_birth' => Carbon::parse($request->date_of_birth)->startOfDay(),
        ]);

        $resident->update($request->all());
        $resident->disabilities()->sync($request->disability ?: []);

        alert()->success(trans('message.ctrl.residents.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resident $resident)
    {
        $this->authorize('residents.manage');

        $resident->delete();

        alert()->success(trans('message.ctrl.residents.destroy'))->persistent("Close");

        return redirect(route('residents.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function showJob(Job $job)
    {
        $this->authorize('residents.manage');

        return view('residents.show_job', compact('job'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function showEducation(Education $education)
    {
        $this->authorize('residents.manage');

        return view('residents.show_education', compact('education'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disability  $disability
     * @return \Illuminate\Http\Response
     */
    public function showDisability(Disability $disability)
    {
        $this->authorize('residents.manage');

        return view('residents.show_disability', compact('disability'));
    }

    /**
     * Get all residents for specific job by ajax request.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJobData(Job $job)
    {
        return Datatables::of($job->residentsWhoHave($job)
                ->with('hometown', 'job', 'education')
                ->get()
            )->addColumn('action', function ($job) {
                $action = '<a href="'. route('jobs.edit', $job) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('jobs.destroy', $job) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Get all residents for specific education by ajax request.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEducationData(Education $education)
    {
        return Datatables::of($education->residentsWhoHave($education)
                ->with('hometown', 'job', 'education')
                ->get()
            )->addColumn('action', function ($job) {
                $action = '<a href="'. route('jobs.edit', $job) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('jobs.destroy', $job) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Get all residents for specific disability by ajax request.
     *
     * @param  \App\Disability  $disability
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDisabilityData(Disability $disability)
    {
        return Datatables::of($disability->residentsWhoHave($disability)
                ->with('hometown', 'job', 'education', 'disabilities')
                ->get()
            )->addColumn('action', function ($disability) {
                $action = '<a href="'. route('disabilities.edit', $disability) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('disabilities.destroy', $disability) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Get all residents for specific job by ajax request.
     *
     * @param  integer  $partition
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPartitionData($partition)
    {
        return Datatables::of(Setting::getPartition()->get($partition-1)[1])
            ->addColumn('action', function ($resident) {
                $action = '<a href="'. route('residents.edit', $resident) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('residents.destroy', $resident) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Get all residents by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResidents()
    {
        return Datatables::of(Resident::with(
                'hometown',
                'education',
                'job',
                'maritalStatus',
                'disabilities'
            )->get())
            ->addColumn('action', function ($resident) {
                $action = '<a href="'. route('residents.show', $resident) .'" class="btn btn-xs btn-success show-this"><i class="fa fa-search-plus"></i> Lihat</a>';
                $action .= '<a href="'. route('residents.edit', $resident) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('residents.destroy', $resident) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Get all men residents by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMenResidents()
    {
        return Datatables::of(Resident::men()->with(
                'hometown',
                'education',
                'job',
                'maritalStatus',
                'disabilities'
            )->get())
            ->addColumn('action', function ($resident) {
                $action = '<a href="'. route('residents.show', $resident) .'" class="btn btn-xs btn-success show-this"><i class="fa fa-search-plus"></i> Lihat</a>';
                $action .= '<a href="'. route('residents.edit', $resident) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('residents.destroy', $resident) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Get all women residents by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWomenResidents()
    {
        return Datatables::of(Resident::women()->with(
                'hometown',
                'education',
                'job',
                'maritalStatus',
                'disabilities'
            )->get())
            ->addColumn('action', function ($resident) {
                $action = '<a href="'. route('residents.show', $resident) .'" class="btn btn-xs btn-success show-this"><i class="fa fa-search-plus"></i> Lihat</a>';
                $action .= '<a href="'. route('residents.edit', $resident) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('residents.destroy', $resident) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
