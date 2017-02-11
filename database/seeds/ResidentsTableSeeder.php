<?php

use App\Resident;
use Illuminate\Database\Seeder;

class ResidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Resident::class, 50)->create();
    }
}
