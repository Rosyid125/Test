<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'accounting'],
            ['name' => 'business development'],
            ['name' => 'engineering'],
            ['name' => 'human resources'],
            ['name' => 'legal'],
            ['name' => 'marketing'],
            ['name' => 'product management'],
            ['name' => 'sales'],
            ['name' => 'training'],
        ]);
    }
}

