<?php

namespace App\Services;

use App\FamilyCard;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface FamilyCardService
{
    /**
     * Sync the patriarch with family card.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @param  \App\FamilyCard  $familyCard
     * @return void
     */
    public function syncPatriarch(Collection $data, FamilyCard $familyCard);

    /**
     * Sync the members with family card.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @param  \App\FamilyCard  $familyCard
     * @return void
     */
    public function syncMembers(Collection $data, FamilyCard $familyCard);

    /**
     * Detach the patriarch with the family card.
     *
     * @param  \App\FamilyCard  $familyCard
     * @return void
     */
    public function detachPatriarch(FamilyCard $familyCard);

    /**
     * Detach the members with the family card.
     *
     * @param  \App\FamilyCard  $familyCard
     * @return void
     */
    public function detachMembers(FamilyCard $familyCard);
}
