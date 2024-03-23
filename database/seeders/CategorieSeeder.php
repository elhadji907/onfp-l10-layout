<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        DB::table('categories')->insert([
        'name' => "3-6",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
        
     DB::table('categories')->insert([
        'name' => "4-1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
        
     DB::table('categories')->insert([
        'name' => "5-1",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
        
     DB::table('categories')->insert([
        'name' => "7-2",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
        
     DB::table('categories')->insert([
        'name' => "3-2",
        'created_at' => now(),
        'updated_at' => now(),
        'uuid' => Str::uuid(),
    ]);
    }
}
