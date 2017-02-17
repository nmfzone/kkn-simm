<?php

namespace App\Http\Controllers;

use App\Http\Requests\VillageRequest;
use App\Village;
use Datatables;

class VillagesController extends Controller
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
        // $this->authorize('villages.manage');
        //
        // return view('villages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('villages.manage');
        //
        // return view('villages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VillageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VillageRequest $request)
    {
        $this->authorize('villages.manage');

        $village = Village::create([
            'sub_district_id' => $request->sub_district_id,
            'name' => $request->village_name,
        ]);

        alert()->success(trans('message.ctrl.villages.store'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function show(Village $village)
    {
        // $this->authorize('villages.manage');
        //
        // return view('villages.show', compact('village'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function edit(Village $village)
    {
        $this->authorize('villages.manage');

        return view('settings.edit', compact('village'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\VillageRequest  $request
     * @param  \App\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function update(VillageRequest $request, Village $village)
    {
        $this->authorize('villages.manage');

        $village->update([
            'sub_district_id' => $request->sub_district_id,
            'name' => $request->village_name,
        ]);

        alert()->success(trans('message.ctrl.villages.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function destroy(Village $village)
    {
        $this->authorize('villages.manage');

        $village->delete();

        alert()->success(trans('message.ctrl.villages.destroy'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Get all villages by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVillages()
    {
        return Datatables::of(Village::all())
            ->addColumn('action', function ($village) {
                $action = '<a href="'. route('villages.edit', $village) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('villages.destroy', $village) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
