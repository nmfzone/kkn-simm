<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubDistrictRequest;
use App\SubDistrict;
use Datatables;

class SubDistrictsController extends Controller
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
        // $this->authorize('sub_districts.manage');
        //
        // return view('sub_districts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('sub_districts.manage');
        //
        // return view('sub_districts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SubDistrictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubDistrictRequest $request)
    {
        $this->authorize('sub_districts.manage');

        $subDistrict = SubDistrict::create([
            'district_id' => $request->district_id,
            'name' => $request->sub_district_name,
            'postal_code' => $request->postal_code,
        ]);

        alert()->success(trans('message.ctrl.sub_districts.store'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function show(SubDistrict $subDistrict)
    {
        // $this->authorize('sub_districts.manage');
        //
        // return view('sub_districts.show', compact('subDistrict'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function edit(SubDistrict $subDistrict)
    {
        $this->authorize('sub_districts.manage');

        return view('settings.edit', compact('subDistrict'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SubDistrictRequest  $request
     * @param  \App\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function update(SubDistrictRequest $request, SubDistrict $subDistrict)
    {
        $this->authorize('sub_districts.manage');

        $subDistrict->update([
            'district_id' => $request->district_id,
            'name' => $request->sub_district_name,
            'postal_code' => $request->postal_code,
        ]);

        alert()->success(trans('message.ctrl.sub_districts.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubDistrict $subDistrict)
    {
        $this->authorize('sub_districts.manage');

        $subDistrict->delete();

        alert()->success(trans('message.ctrl.sub_districts.destroy'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Get all sub_districts by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubDistricts()
    {
        return Datatables::of(SubDistrict::all())
            ->addColumn('action', function ($subDistrict) {
                $action = '<a href="'. route('sub_districts.edit', $subDistrict) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('sub_districts.destroy', $subDistrict) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
