<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistrictRequest;
use App\District;
use Datatables;

class DistrictsController extends Controller
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
        // $this->authorize('districts.manage');
        //
        // return view('districts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('districts.manage');
        //
        // return view('districts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DistrictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {
        $this->authorize('districts.manage');

        $district = District::create([
            'province_id' => $request->province_id,
            'name' => $request->district_name,
        ]);

        alert()->success(trans('message.ctrl.districts.store'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        // $this->authorize('districts.manage');
        //
        // return view('districts.show', compact('district'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $this->authorize('districts.manage');

        return view('settings.edit', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DistrictRequest  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, District $district)
    {
        $this->authorize('districts.manage');

        $district->update([
            'province_id' => $request->province_id,
            'name' => $request->district_name,
        ]);

        alert()->success(trans('message.ctrl.districts.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $this->authorize('districts.manage');

        $district->delete();

        alert()->success(trans('message.ctrl.districts.destroy'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Get all districts by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistricts()
    {
        return Datatables::of(District::all())
            ->addColumn('action', function ($district) {
                $action = '<a href="'. route('districts.edit', $district) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('districts.destroy', $district) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
