<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Gender;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
        $genders = [

            ['en'=> 'Male','ar'=> 'ذكر'],
            ['en'=> 'Female','ar'=> 'أنثي'],
          
        ];

        foreach ($genders as $R) {
            Gender::create(['Name' => $R]);
        }
    }
}
