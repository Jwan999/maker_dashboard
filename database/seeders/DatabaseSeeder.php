<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'phone' => Str::random(10),
            'gender' => Str::random(10),
            'field_of_study' => Str::random(10),
            'governorate' => Str::random(10),
            'university' => Str::random(10),
            'date_of_birth' => Carbon::parse('2000-01-01'),
        ]);
        DB::table('trainings')->insert([
            'name' => Str::random(10),
            'type' => Str::random(10),
            'period' => Str::random(10),
            'in_person' => Str::contains('hello', 'hello'),
            'date' => Carbon::parse('2000-01-01'),
        ]);
    }


}
