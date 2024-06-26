<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types_formations')->insert([
            'name' => "Individuelle",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('types_formations')->insert([
            'name' => "Collective",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
    }
}
