<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('directions')->insert([
            'name' => "Direction Général",
            "sigle"=> "DG",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Secrétaire Général",
            "sigle"=> "SG",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction Administrative et Financière ",
            "sigle"=> "DAF",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction de la Construction et de l'Equipement des Centres de Formation",
            "sigle"=> "DCECF",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction des Evaluations et Certifications ",
            "sigle"=> "DEC",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction de l'Ingénierie et des Opérations de Formation",
            "sigle"=> "DIOF",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Cellule Passation des Marchés",
            "sigle"=> "CPM",
            'type'=> 'Cellule',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction de la Planification et des Projets",
            "sigle"=> "DPP",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Cellule Coopération et Partenariat",
            "sigle"=> "CCP",
            'type'=> 'Cellule',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Conseillers Techniques",
            "sigle"=> "CT",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Agence comptable",
            "sigle"=> "AC",
            'type'=> 'Service',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Cellule Juridique",
            "sigle"=> "CJ",
            'type'=> 'Cellule',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Centre de Ressources Documentation et Information",
            "sigle"=> "CRDI",
            'type'=> 'Service',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Coordination des Antennes Régionales",
            "sigle"=> "CAR",
            'type'=> 'Service',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Service Accueil, Orientation Sécurité et Suivi des Formés",
            "sigle"=> "SAOS",
            'type'=> 'Service',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Service Informatique",
            "sigle"=> "SI",
            'type'=> 'Service',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Audit Interne",
            "sigle"=> "AI",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Contrôle de Gestion",
            "sigle"=> "CG",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Cellule suivi évaluation",
            "sigle"=> "CSE",
            'type'=> 'Cellule',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Cellule Marketing et Communication",
            "sigle"=> "COM",
            'type'=> 'Cellule',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Direction des Ressources Humaines",
            "sigle"=> "DRH",
            'type'=> 'Direction',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Bureau du Courrier",
            "sigle"=> "BC",
            'type'=> 'Bureau',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Service d'Elaboration de Ressources de Formation",
            "sigle"=> "SERF",
            'type'=> 'Service',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Unité de Recherche et Développement ",
            "sigle"=> "URD",
            'type'=> 'Service',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
    }
}
