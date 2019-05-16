<?php


use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pos=[
            [
                'id_department'=> 1,
                'position_name'=>'Intern',
                'description'=>Str::random(20)
            ],
            [
                'id_department'=> 1,
                'position_name'=>'Fresher',
                'description'=>Str::random(20)
            ],
            [
                'id_department'=> 3,
                'position_name'=>'Senior',
                'description'=>Str::random(20)
            ],
            [
                'id_department'=> 2,
                'position_name'=>'Junior',
                'description'=>Str::random(20)
            ],
            [
                'id_department'=> 1,
                'position_name'=>'Coder',
                'description'=>Str::random(20)
            ]
        ];
        DB::table('tblposition')->insert($pos);
    }
}
