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
        $nik = 3310042305010000;

        foreach (range(1, 5000) as $item) {
            factory(Resident::class)->create([
                'nik' => $nik++,
            ]);
        }
    }
}
