<?php

use App\User;
use Illuminate\Database\Seeder;

class PreliminaryDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Artisan::call('bouncer:seed');

        factory(User::class)->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => '12345678',
        ])->assign("Administrator");
    }
}
