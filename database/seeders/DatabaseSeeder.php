<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    /**
     * List of applications to add.
     */
    private $permissions = [
        'role-create',
        'role-update',
        'role-show',
        'role-view',
        'role-delete',
        'give-role-permissions',
        'user-create',
        'user-update',
        'user-show',
        'user-view',
        'user-delete',
        'employe-create',
        'employe-update',
        'employe-show',
        'employe-view',
        'employe-delete',
        'direction-create',
        'direction-update',
        'direction-show',
        'direction-view',
        'direction-delete',
        'permission-create',
        'permission-update',
        'permission-show',
        'permission-view',
        'permission-delete',
        'arrive-create',
        'arrive-update',
        'arrive-show',
        'arrive-view',
        'arrive-delete',
        'depart-create',
        'depart-update',
        'depart-show',
        'depart-view',
        'depart-delete',
        'interne-create',
        'interne-update',
        'interne-show',
        'interne-view',
        'interne-delete',
        'categorie-create',
        'categorie-update',
        'categorie-show',
        'categorie-view',
        'categorie-delete',
    ];

    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


        // Create admin User and assign the role to him.
       /*  $user = User::create([
            'name' => 'Prevail Ejimadu',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]); */

        /* $role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);
 */
        /* $user->assignRole([$role->id]); */


        $this->call([
            CategorieSeeder::class,
            SecteurSeeder::class,
            DomaineSeeder::class,
            ModuleSeeder::class,
            DiplomeSeeder::class,
            DiplomeproSeeder::class,
            RegionSeeder::class,
            DepartementSeeder::class,
            ArrondissementSeeder::class,
            CommuneSeeder::class,
            FonctionSeeder::class,
            DirectionSeeder::class,
            AdministrateurSeeder::class,
            GestionnaireSeeder::class,
            EmployeeSeeder::class,
            RoleSeeder::class,
            LoiSeeder::class,
            DecretSeeder::class,
            ProcesverbalSeeder::class,
            DecisionSeeder::class,
            ArticleSeeder::class,
            NomminationSeeder::class,
            IndemniteSeeder::class,
            TypeformationSeeder::class,
            ProjetSeeder::class,
            IndividuelleSeeder::class,
        ]);
    }
}
