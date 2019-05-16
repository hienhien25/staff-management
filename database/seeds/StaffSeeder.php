<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= \Faker\Factory::create();
        $staff=[];
        for ($i=0;$i<50;$i++) {
            $s = [
                'id_department' => rand(1, 3),
                'image'=>"images/".rand(1, 10).'.jpeg',
                'fullname' => $faker->name,
                'email' => Str::random(10).'@gmail.com',
                'password' => bcrypt('secret'),
                'role' => rand(0, 1)
            ];
            array_push($staff, $s);
        }
        DB::table('users')->insert($staff);
    }
}
