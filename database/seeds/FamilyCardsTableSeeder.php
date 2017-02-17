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
        factory(FamilyCard::class, 5)->create()->each(function($familyCard) {
            $data = collect([
                'patriarch' => App\Resident::all()->random()->id,
            ]);

            $this->familyCardService->syncPatriarch($data, $familyCard);
        });
    }
}
