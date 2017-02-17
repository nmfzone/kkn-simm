<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PreliminaryDataSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(SubDistrictsTableSeeder::class);
        $this->call(VillagesTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(EducationTableSeeder::class);
        $this->call(MaritalStatusesTableSeeder::class);
        $this->call(ResidentsTableSeeder::class);
        $this->call(DisabilitiesTableSeeder::class);
        $this->call(FamilyCardsTableSeeder::class);
    }
}
