<?php

namespace App\Http\Controllers;

use App\FamilyCard;
use App\Http\Requests\FamilyCardRequest;
use App\Setting;
use App\Services\FamilyCardService;
use Carbon\Carbon;
use Datatables;

class FamilyCardsController extends Controller
{
    /**
     * @var \App\Services\FamilyCardService
     */
    protected $familyCardService;

    /**
     * Constructor.
     *
     * @param  \App\Services\FamilyCardService  $familyCardService
     * @return void
     */
    public function __construct(FamilyCardService $familyCardService)
    {
        $this->familyCardService = $familyCardService;
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
     * Display the specified resource.
     *
     * @param  string  $kadus
     * @return \Illuminate\Http\Response
     */
    public function showKadus($kadus)
    {
        $this->authorize('family_cards.manage');

        if (! Setting::getKadus()->contains(ucwords($kadus))) {
            return abort(404);
        }

        return view('family_cards.show_kadus', compact('kadus'));
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

        $request->merge([
            'issued_on' => Carbon::parse($request->issued_on)->startOfDay(),
        ]);

        $familyCard = FamilyCard::create($request->all());
        $data = collect($request->all());

        $this->familyCardService->manageAlteration($data);
        $this->familyCardService->syncPatriarch($data, $familyCard);
        $this->familyCardService->syncMembers($data, $familyCard);

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

        $this->checkRWAbility($familyCard);

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

        $this->checkRWAbility($familyCard);

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

        $this->checkRWAbility($familyCard);

        $request->merge([
            'issued_on' => Carbon::parse($request->issued_on)->startOfDay(),
        ]);

        $familyCard->update($request->all());
        $data = collect($request->all());

        $this->familyCardService->manageAlteration($data);
        $this->familyCardService->syncPatriarch($data, $familyCard);
        $this->familyCardService->syncMembers($data, $familyCard);

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

        $this->checkRWAbility($familyCard);

        $this->familyCardService->detachPatriarch($familyCard);
        $this->familyCardService->detachMembers($familyCard);
        $familyCard->delete();

        alert()->success(trans('message.ctrl.family_cards.destroy'))->persistent("Close");

        return redirect(route('family_cards.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FamilyCard  $familyCard
     * @param  \App\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroyMember(FamilyCard $familyCard, Resident $resident)
    {
        $this->authorize('family_cards.manage');

        $this->checkRWAbility($familyCard);

        if (! $familyCard->members()->find($resident)) {
            return abort(404);
        }

        $familyCard->members()->detach([$resident->id]);

        alert()->success(trans('message.ctrl.family_cards.destroy_member'))->persistent("Close");

        return redirect(route('family_cards.index'));
    }

    /**
     * Get all family cards by ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFamilyCards()
    {
        $familyCards = FamilyCard::with('village', 'members');

        if (auth()->user()->isAn('Administrator')) {
            $familyCards = $familyCards->get();
        } else {
            $familyCards = $familyCards->RW(explode(' ', auth()->user()->position)[2])->get();
        }

        return Datatables::of($familyCards)
            ->addColumn('action', function ($family_card) {
                $action = '<a href="'. route('family_cards.show', $family_card) .'" class="btn btn-xs btn-success show-this"><i class="fa fa-search-plus"></i></a>';
                $action .= '<a href="'. route('family_cards.edit', $family_card) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i></a>';
                $action .= '<a href="'. route('family_cards.destroy', $family_card) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i></a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Get all family card for specific kadus by ajax request.
     *
     * @param  string  $kadus
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByKadus($kadus)
    {
        if (! Setting::getKadus()->contains(ucwords($kadus))) {
            return abort(404);
        }

        return Datatables::of(FamilyCard::where('kadus', $kadus)
            ->with(
                'village',
                'members'
            )->get())
            ->addColumn('action', function ($family_card) {
                if (auth()->user()->isNotAn('Administrator') && $family_card->rw != explode(' ', auth()->user()->position)[2]) {
                    $action = '-';
                } else {
                    $action = '<a href="'. route('family_cards.show', $family_card) .'" class="btn btn-xs btn-success show-this"><i class="fa fa-search-plus"></i></a>';
                    $action .= '<a href="'. route('family_cards.edit', $family_card) .'" class="btn btn-xs btn-primary m-l-10"><i class="fa fa-edit"></i></a>';
                    $action .= '<a href="'. route('family_cards.destroy', $family_card) .'" class="btn btn-xs btn-primary delete-this m-l-10"><i class="fa fa-remove"></i></a>';
                }

                return $action;
            })
            ->make(true);
    }
}
