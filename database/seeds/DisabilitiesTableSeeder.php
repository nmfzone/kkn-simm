<?php

use App\Disability;
use App\Resident;
use Illuminate\Database\Seeder;

class DisabilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Disability::class, 5)->create()->each(function($disability) {
            $disability->residents()->save(Resident::all()->random());
        });
    }
}
