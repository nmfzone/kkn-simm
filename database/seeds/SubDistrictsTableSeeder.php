<?php

use App\SubDistrict;
use Illuminate\Database\Seeder;

class SubDistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SubDistrict::class, 5)->create();
    }
}
