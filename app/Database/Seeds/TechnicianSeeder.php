<?php

namespace App\Database\Seeds;

use App\Models\Technician;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class TechnicianSeeder extends Seeder
{
    public function run()
    {
        $technician = new Technician();
        $faker = \Faker\Factory::create();

        for( $i = 0; $i < 10; $i++ ){
            $technician->save([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'created_at' => Time::createFromTimestamp( $faker->unixTime() ),
                'updated_at' => Time::now()
            ]);
        }
        //
    }
}
