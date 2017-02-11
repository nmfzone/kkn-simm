<?php

use App\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MaritalStatus::class, 5)->create();
    }
}
