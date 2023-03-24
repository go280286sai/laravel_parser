<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->insert([
            ['id' => 0, 'name' => 'not known'],
            ['id' => 1, 'name' => 'male'],
            ['id' => 2, 'name' => 'female'],
            ['id' => 9, 'name' => 'not applicable'],
        ]);
    }
}
