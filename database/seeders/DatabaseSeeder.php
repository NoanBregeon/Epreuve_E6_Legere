<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\BouncerFacade as Bouncer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Définir les rôles et capacités Bouncer
        Bouncer::allow('admin')->to('manage-products');
        Bouncer::allow('admin')->to('manage-orders');
        Bouncer::allow('admin')->to('access-dashboard');

        // Créer un utilisateur admin
        $admin = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@drive.test',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'role' => 'admin',
        ]);
        Bouncer::assign('admin')->to($admin);

        // Créer un utilisateur éditeur (pour l'appli lourde)
        $editeur = User::create([
            'name' => 'Editeur App',
            'email' => 'editeur@drive.test',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'role' => 'editeur',
        ]);
        // On peut aussi lui donner des droits Bouncer si besoin
        // Bouncer::assign('editeur')->to($editeur);

        // Créer un utilisateur normal pour les tests
        $user = User::create([
            'name' => 'Jean Dupont',
            'email' => 'user@drive.test',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'role' => 'client',
        ]);
        // Pas de rôle spécial pour l'utilisateur lambda

        // Créer quelques clients
        Client::create([
            'nom' => 'Martin',
            'prenom' => 'Sophie',
            'email' => 'sophie.martin@example.com',
            'telephone' => '0612345678',
        ]);

        Client::create([
            'nom' => 'Durand',
            'prenom' => 'Pierre',
            'email' => 'pierre.durand@example.com',
            'telephone' => '0698765432',
        ]);

        // Créer des produits variés (1000 produits via Factory)
        Produit::factory()->count(1000)->create();

        $this->call([
            CommandesSeeder::class,
            PromotionsSeeder::class,
        ]);
    }
}
