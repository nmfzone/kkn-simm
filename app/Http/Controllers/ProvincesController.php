<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinceRequest;
use App\Province;
use Datatables;

class ProvincesController extends Controller
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
        // $this->authorize('provinces.manage');
        //
        // return view('provinces.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('provinces.manage');
        //
        // return view('provinces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProvinceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinceRequest $request)
    {
        $this->authorize('provinces.manage');

        $province = Province::create([
            'name' => $request->province_name,
        ]);

        alert()->success(trans('message.ctrl.provinces.store'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        // $this->authorize('provinces.manage');
        //
        // return view('provinces.show', compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        $this->authorize('provinces.manage');

        return view('settings.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProvinceRequest  $request
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinceRequest $request, Province $province)
    {
        $this->authorize('provinces.manage');

        $province->update([
            'name' => $request->province_name,
        ]);

        alert()->success(trans('message.ctrl.provinces.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        $this->authorize('provinces.manage');

        $province->delete();

        alert()->success(trans('message.ctrl.provinces.destroy'))->persistent("Close");

        return redirect(route('settings.index'));
    }

    /**
     * Get all provinces by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProvinces()
    {
        return Datatables::of(Province::all())
            ->addColumn('action', function ($province) {
                $action = '<a href="'. route('provinces.edit', $province) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('provinces.destroy', $province) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
