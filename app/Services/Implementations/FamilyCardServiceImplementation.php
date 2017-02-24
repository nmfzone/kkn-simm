<?php

namespace App\Services\Implementations;

use App\Services\FamilyCardService;
use App\FamilyCard;
use App\FamilyCardMember;
use App\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FamilyCardServiceImplementation extends BaseService implements FamilyCardService
{
    /**
     * Manage the alteration of the family card's member.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @return void
     */
    public function manageAlteration(Collection $data)
    {
        // Patriarch
        // Delete the old family card where he becoming patriarch.
        $resident = Resident::find($data->get('patriarch'));

        if (! is_null($resident->familyCard()) && $resident->amIPatriarch()) {
             $familyCard = $resident->familyCard();
             $this->detachPatriarch($familyCard);
             $this->detachMembers($familyCard);
             $familyCard->delete();
        }


        // Member
        // Delete the member from the old's family card.
        FamilyCardMember::where(function($query) use ($data) {
                $query->whereIn('resident_id', $data->get('family_member_id'))
                    ->orWhere('resident_id', $data->get('patriarch'));
            })
            ->where('is_patriarch', false)
            ->delete();
    }

    /**
     * Sync the patriarch with family card.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @param  \App\FamilyCard  $familyCard
     * @return void
     */
    public function syncPatriarch(Collection $data, FamilyCard $familyCard)
    {
        $resident = Resident::find($data->get('patriarch'));

        $this->detachPatriarch($familyCard);

        $familyCard->members()->attach([
            $resident->id => [ 'is_patriarch' => true ],
        ]);
    }

    /**
     * Sync the members with the family card.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @param  \App\FamilyCard  $familyCard
     * @return void
     */
    public function syncMembers(Collection $data, FamilyCard $familyCard)
    {
        $this->detachMembers($familyCard);

        if ($data->get('family_member')) {
            $familyCard->members()->attach($data->get('family_member_id'));
        }
    }

    /**
     * Detach the patriarch with the family card.
     *
     * @param  \App\FamilyCard  $familyCard
     * @return void
     */
    public function detachPatriarch(FamilyCard $familyCard)
    {
        if (! is_null($familyCard->patriarch)) {
            $familyCard->members()->detach([$familyCard->patriarch->id]);
        }
    }

    /**
     * Detach the members with the family card.
     *
     * @param  \App\FamilyCard  $familyCard
     * @return void
     */
    public function detachMembers(FamilyCard $familyCard)
    {
        if (! $familyCard->nonPatriarch->isEmpty()) {
            $familyCard->members()->detach($familyCard->nonPatriarch->pluck('id')->all());
        }
    }
}
