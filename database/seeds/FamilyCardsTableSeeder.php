<?php

use App\FamilyCard;
use App\Resident;
use App\Services\FamilyCardService;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class FamilyCardsTableSeeder extends Seeder
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
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $number = 3310043007100000;

        foreach (range(1, 900) as $item) {
            $familyCard = factory(FamilyCard::class)->create([
                'number' => $number++,
            ]);

            $patriarchData = collect([
                'patriarch' => App\Resident::whereHas('familyCards', null, '=', 0)
                    ->first()->id,
            ]);

            $membersData = collect([
                'family_member' => true,
                'family_member_id' => Resident::whereHas('familyCards', null, '=', 0)
                    ->where('id', '!=', $patriarchData->get('patriarch'))
                    ->take(4)->pluck('id')
                    ->all(),
            ]);

            $this->familyCardService->syncPatriarch($patriarchData, $familyCard);
            $this->familyCardService->syncMembers($membersData, $familyCard);
        }
    }
}
