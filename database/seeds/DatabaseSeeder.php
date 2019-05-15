<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StaffSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(DetailSeeder::class);
        $this->call(TimeSeeder::class);
    }
}
