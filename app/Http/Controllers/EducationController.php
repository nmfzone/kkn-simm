<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\Education;
use Datatables;

class EducationController extends Controller
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
        // $this->authorize('education.manage');
        //
        // return view('education.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('education.manage');
        //
        // return view('education.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EducationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationRequest $request)
    {
        $this->authorize('education.manage');

        $education = Education::create([
            'name' => $request->education_name,
        ]);

        alert()->success(trans('message.ctrl.education.store'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        // $this->authorize('education.manage');
        //
        // return view('education.show', compact('education'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        $this->authorize('education.manage');

        return view('settings.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EducationRequest  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(EducationRequest $request, Education $education)
    {
        $this->authorize('education.manage');

        $education->update([
            'name' => $request->education_name,
        ]);

        alert()->success(trans('message.ctrl.education.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $this->authorize('education.manage');

        $education->delete();

        alert()->success(trans('message.ctrl.education.destroy'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Get all education by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEducation()
    {
        return Datatables::of(Education::all())
            ->addColumn('action', function ($education) {
                $action = '<a href="'. route('education.edit', $education) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('education.destroy', $education) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
