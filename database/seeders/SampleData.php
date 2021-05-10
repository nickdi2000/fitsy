<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              DB::table('exercises')->insert([
                 //'name' => Str::random(10),
                 [
                 'name' => 'Dead Lifts',
                 'description' => 'Barbell deadlifts can be done in standard form or romanian-style',
                 'user_id' => 1,
                 'id' => 1,
                ],
                [
                  'name' => 'Chinups',
                  'description' => 'Also known as pull-ups',
                  'user_id' => 1,
                  'id' => 2,
                ]
             ]);



             DB::table('day_exercises')->insert([
                //'name' => Str::random(10),
                [
                  'user_id' => 1,
                  'day_id' => 1,
                  'exercise_id' => 1,
                  'id' => 1,
               ],
               [
                 'user_id' => 1,
                 'day_id' => 1,
                 'exercise_id' => 1,
                 'id' => 2,
              ],
            ]);


    }


}
