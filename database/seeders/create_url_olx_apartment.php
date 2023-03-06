<?php

namespace Database\Seeders;

use App\Models\Research;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class create_url_olx_apartment extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Research::add(['title'=>'olx_apartment', 'url'=>'null']);
    }
}
