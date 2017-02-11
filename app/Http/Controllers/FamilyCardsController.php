<?php

namespace App\Http\Controllers;

use App\Http\Requests\FamilyCardRequest;
use App\FamilyCard;
use Datatables;

class FamilyCardsController extends Controller
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
        $this->authorize('family_cards.manage');

        return view('family_cards.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('family_cards.manage');

        return view('family_cards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FamilyCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FamilyCardRequest $request)
    {
        $this->authorize('family_cards.manage');

        $familyCard = FamilyCard::create($request->all());

        alert()->success(trans('message.ctrl.family_cards.store'))->persistent("Close");

        return redirect(route('family_cards.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FamilyCard  $familyCard
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyCard $familyCard)
    {
        $this->authorize('family_cards.manage');

        return view('family_cards.show', compact('familyCard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FamilyCard  $familyCard
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyCard $familyCard)
    {
        $this->authorize('family_cards.manage');

        return view('family_cards.edit', compact('familyCard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FamilyCardRequest  $request
     * @param  \App\FamilyCard  $familyCard
     * @return \Illuminate\Http\Response
     */
    public function update(FamilyCardRequest $request, FamilyCard $familyCard)
    {
        $this->authorize('family_cards.manage');

        alert()->success(trans('message.ctrl.family_cards.update'))->persistent("Close");

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FamilyCard  $familyCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyCard $familyCard)
    {
        $this->authorize('family_cards.manage');

        $familyCard->delete();

        alert()->success(trans('message.ctrl.family_cards.destroy'))->persistent("Close");

        return redirect(route('family_cards.index'));
    }

    /**
     * Get all family cards by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFamilyCards()
    {
        return Datatables::of(FamilyCard::all())
            ->addColumn('action', function ($family_card) {
                $action = '<a href="'. route('family_cards.show', $family_card) .'" class="btn btn-xs btn-success show-this"><i class="fa fa-search-plus"></i> Lihat</a>';
                $action .= '<a href="'. route('family_cards.edit', $family_card) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i> Edit</a>';
                $action .= '<a href="'. route('family_cards.destroy', $family_card) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i> Hapus</a>';
                return $action;
            })
            ->make(true);
    }
}
