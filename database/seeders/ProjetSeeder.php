<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjetSeeder extends Seeder
{
     /**
      * Run the database seeds.
      */
     public function run(): void
     {
          DB::table('projets')->insert([
               "name" => "Projet d'employabilite des jeunes par l'apprentissage",
               "sigle" => "PEJA",
               "description" => "description",
               "budjet" => "123",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
          ]);

          DB::table('projets')->insert([
               "name" => "Projet d’appui au Développement des Compétences et de l’Entreprenariat des Jeunes dans les secteurs porteurs",
               "sigle" => "PDCEJ",
               "description" => "description",
               "budjet" => "123",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
          ]);

          DB::table('projets')->insert([
               "name" => "Accès équitable à la formation professionnelle",
               "sigle" => "ACEFOP",
               "description" => "description",
               "budjet" => "123",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
          ]);

          DB::table('projets')->insert([
               "name" => "PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD",
               "sigle" => "AGEROUTE-SENOZIG",
               "description" => "description",
               "budjet" => "123",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
          ]);

          DB::table('projets')->insert([
               "name" => "Programme de Désenclavement des Zones agricoles et Minières",
               "sigle" => "PDZAM-1",
               "description" => "Globalement le programme concerne l'aménagement et la réhabilitation de 786,20 km de routes. Toutefois les composantes financées par la BAD/AGTF, le FERA et le Gouvernement du Sénégal concernent les routes de la Boucle du riz (172,44 km), la section Keur Momar Sarr- Richard Toll (74,00 km) y compris 6 km de voirie à Richard TOLL et à Keur Momar Sarret la piste Nguer Malal - Loumbeul - Keur Malick Sow (17 km), et le renforcement de 25 km de routes sur la N2 entre Thiès et Kébémer.",
               "budjet" => "250000000",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
          ]);
     }
}
