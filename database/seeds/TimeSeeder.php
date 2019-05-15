<?php

use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time=[
        	['month'=>'4'],
            ['month'=>'5']
        ];
        DB::table('tbltime')->insert($time);
    }
}
