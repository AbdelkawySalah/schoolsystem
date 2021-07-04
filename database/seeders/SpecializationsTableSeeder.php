<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Specializations;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [

            ['en'=> 'Arabic','ar'=> 'عربي'],
            ['en'=> 'Sciences','ar'=> 'علوم'],
            ['en'=> 'Computer','ar'=> 'حاسب الي'],
            ['en'=> 'English','ar'=> 'انجليزي'],

          
        ];

        foreach ($specializations as $R) {
            Specializations::create(['Name' => $R]);
        }

    }
}
