<?php

use App\Village;
use Illuminate\Database\Seeder;

class VillagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Village::class, 5)->create();
    }
}
