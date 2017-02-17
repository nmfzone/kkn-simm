<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisabilityRequest;
use App\Disability;
use Datatables;

class DisabilitiesController extends Controller
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
        // $this->authorize('disabilities.manage');
        //
        // return view('disabilities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('disabilities.manage');
        //
        // return view('disabilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DisabilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisabilityRequest $request)
    {
        $this->authorize('disabilities.manage');

        $disability = Disability::create([
            'name' => $request->disability_name,
        ]);

        alert()->success(trans('message.ctrl.disabilities.store'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disability  $disability
     * @return \Illuminate\Http\Response
     */
    public function show(Disability $disability)
    {
        // $this->authorize('disabilities.manage');
        //
        // return view('disabilities.show', compact('disability'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disability  $disability
     * @return \Illuminate\Http\Response
     */
    public function edit(Disability $disability)
    {
        $this->authorize('disabilities.manage');

        return view('settings.edit', compact('disability'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DisabilityRequest  $request
     * @param  \App\Disability  $disability
     * @return \Illuminate\Http\Response
     */
    public function update(DisabilityRequest $request, Disability $disability)
    {
        $this->authorize('disabilities.manage');

        $disability->update([
            'name' => $request->disability_name,
        ]);

        alert()->success(trans('message.ctrl.disabilities.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disability  $disability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disability $disability)
    {
        $this->authorize('disabilities.manage');

        $disability->delete();

        alert()->success(trans('message.ctrl.disabilities.destroy'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Get all disabilities by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDisabilities()
    {
        return Datatables::of(Disability::all())
            ->addColumn('action', function ($disability) {
                $action = '<a href="'. route('disabilities.edit', $disability) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('disabilities.destroy', $disability) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
