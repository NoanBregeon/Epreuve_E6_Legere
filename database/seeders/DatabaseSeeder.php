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

        // Créer des produits variés (20 produits réalistes)
        $produits = [
            // Fruits & Légumes
            [
                'reference' => 'FRL001',
                'libelle' => 'Pommes Bio (1kg)',
                'description' => 'Pommes biologiques de nos producteurs locaux. Variété Golden, parfaites pour les tartes ou à croquer.',
                'prix_ht' => 3.99,
                'tva' => 5.5,
                'stock' => 150,
                'actif' => true,
                'categorie' => 'Fruits & Légumes',
            ],
            [
                'reference' => 'FRL002',
                'libelle' => 'Tomates en Grappe (1kg)',
                'description' => 'Tomates fraîches en grappe, cultivées en France. Idéales pour les salades.',
                'prix_ht' => 2.99,
                'tva' => 5.5,
                'stock' => 80,
                'actif' => true,
                'categorie' => 'Fruits & Légumes',
            ],
            [
                'reference' => 'FRL003',
                'libelle' => 'Bananes (1kg)',
                'description' => 'Bananes Cavendish, origine Amérique Latine.',
                'prix_ht' => 1.89,
                'tva' => 5.5,
                'stock' => 200,
                'actif' => true,
                'categorie' => 'Fruits & Légumes',
            ],
            [
                'reference' => 'FRL004',
                'libelle' => 'Carottes des Sables (1kg)',
                'description' => 'Carottes non lavées pour une meilleure conservation.',
                'prix_ht' => 1.50,
                'tva' => 5.5,
                'stock' => 100,
                'actif' => true,
                'categorie' => 'Fruits & Légumes',
            ],

            // Boulangerie
            [
                'reference' => 'BOU001',
                'libelle' => 'Baguette Tradition',
                'description' => 'Baguette tradition française cuite au four, croustillante à souhait.',
                'prix_ht' => 1.10,
                'tva' => 5.5,
                'stock' => 120,
                'actif' => true,
                'categorie' => 'Boulangerie',
            ],
            [
                'reference' => 'BOU002',
                'libelle' => 'Pain Complet',
                'description' => 'Pain complet aux céréales, riche en fibres.',
                'prix_ht' => 2.50,
                'tva' => 5.5,
                'stock' => 45,
                'actif' => true,
                'categorie' => 'Boulangerie',
            ],
            [
                'reference' => 'BOU003',
                'libelle' => 'Croissants au Beurre (x4)',
                'description' => 'Sachet de 4 croissants pur beurre.',
                'prix_ht' => 3.80,
                'tva' => 5.5,
                'stock' => 30,
                'actif' => true,
                'categorie' => 'Boulangerie',
            ],

            // Crémerie
            [
                'reference' => 'CRE001',
                'libelle' => 'Lait Bio Demi-Écrémé (1L)',
                'description' => 'Lait demi-écrémé biologique, origine France.',
                'prix_ht' => 1.45,
                'tva' => 5.5,
                'stock' => 90,
                'actif' => true,
                'categorie' => 'Crémerie',
            ],
            [
                'reference' => 'CRE002',
                'libelle' => 'Yaourts Nature (x8)',
                'description' => 'Yaourts nature au lait entier, pack de 8.',
                'prix_ht' => 3.20,
                'tva' => 5.5,
                'stock' => 60,
                'actif' => true,
                'categorie' => 'Crémerie',
            ],
            [
                'reference' => 'CRE003',
                'libelle' => 'Beurre Doux (250g)',
                'description' => 'Beurre doux, 82% de matière grasse.',
                'prix_ht' => 2.80,
                'tva' => 5.5,
                'stock' => 75,
                'actif' => true,
                'categorie' => 'Crémerie',
            ],
            [
                'reference' => 'CRE004',
                'libelle' => 'Comté AOP 12 mois (200g)',
                'description' => 'Fromage Comté affiné 12 mois, goût fruité.',
                'prix_ht' => 5.50,
                'tva' => 5.5,
                'stock' => 40,
                'actif' => true,
                'categorie' => 'Crémerie',
            ],

            // Épicerie
            [
                'reference' => 'EPI001',
                'libelle' => 'Pâtes Spaghetti (500g)',
                'description' => 'Pâtes de semoule de blé dur de qualité supérieure.',
                'prix_ht' => 1.20,
                'tva' => 5.5,
                'stock' => 150,
                'actif' => true,
                'categorie' => 'Épicerie',
            ],
            [
                'reference' => 'EPI002',
                'libelle' => 'Riz Basmati (1kg)',
                'description' => 'Riz basmati long grain, origine Inde.',
                'prix_ht' => 3.50,
                'tva' => 5.5,
                'stock' => 100,
                'actif' => true,
                'categorie' => 'Épicerie',
            ],
            [
                'reference' => 'EPI003',
                'libelle' => 'Huile d\'Olive Vierge Extra (75cl)',
                'description' => 'Huile d\'olive vierge extra, première pression à froid.',
                'prix_ht' => 6.90,
                'tva' => 20,
                'stock' => 50,
                'actif' => true,
                'categorie' => 'Épicerie',
            ],
            [
                'reference' => 'EPI004',
                'libelle' => 'Café Moulu Arabica (250g)',
                'description' => 'Café 100% Arabica, torréfaction artisanale.',
                'prix_ht' => 4.20,
                'tva' => 5.5,
                'stock' => 60,
                'actif' => true,
                'categorie' => 'Épicerie',
            ],

            // Boissons
            [
                'reference' => 'BOI001',
                'libelle' => 'Jus d\'Orange (1L)',
                'description' => 'Jus d\'orange 100% pur jus, sans sucres ajoutés.',
                'prix_ht' => 2.10,
                'tva' => 5.5,
                'stock' => 80,
                'actif' => true,
                'categorie' => 'Boissons',
            ],
            [
                'reference' => 'BOI002',
                'libelle' => 'Eau Minérale (6x1.5L)',
                'description' => 'Pack de 6 bouteilles d\'eau minérale naturelle.',
                'prix_ht' => 3.50,
                'tva' => 5.5,
                'stock' => 120,
                'actif' => true,
                'categorie' => 'Boissons',
            ],
            [
                'reference' => 'BOI003',
                'libelle' => 'Cola (1.5L)',
                'description' => 'Boisson gazeuse rafraîchissante.',
                'prix_ht' => 1.80,
                'tva' => 5.5,
                'stock' => 100,
                'actif' => true,
                'categorie' => 'Boissons',
            ],

            // Viandes & Poissons
            [
                'reference' => 'VIA001',
                'libelle' => 'Poulet Fermier Label Rouge',
                'description' => 'Poulet fermier élevé en plein air, environ 1.5kg.',
                'prix_ht' => 8.90,
                'tva' => 5.5,
                'stock' => 25,
                'actif' => true,
                'categorie' => 'Viandes & Poissons',
            ],
            [
                'reference' => 'VIA002',
                'libelle' => 'Saumon Fumé (200g)',
                'description' => 'Saumon fumé d\'Écosse, tranché finement.',
                'prix_ht' => 7.50,
                'tva' => 5.5,
                'stock' => 30,
                'actif' => true,
                'categorie' => 'Viandes & Poissons',
            ],
            [
                'reference' => 'VIA003',
                'libelle' => 'Steak Haché 5% MG (x2)',
                'description' => 'Steaks hachés pur bœuf, origine France.',
                'prix_ht' => 4.50,
                'tva' => 5.5,
                'stock' => 40,
                'actif' => true,
                'categorie' => 'Viandes & Poissons',
            ],

            // Surgelés
            [
                'reference' => 'SUR001',
                'libelle' => 'Pizza Margherita',
                'description' => 'Pizza surgelée margherita, 400g.',
                'prix_ht' => 3.99,
                'tva' => 5.5,
                'stock' => 70,
                'actif' => true,
                'categorie' => 'Surgelés',
            ],
            [
                'reference' => 'SUR002',
                'libelle' => 'Glaces Vanille (1L)',
                'description' => 'Crème glacée à la vanille de Madagascar.',
                'prix_ht' => 3.50,
                'tva' => 5.5,
                'stock' => 50,
                'actif' => true,
                'categorie' => 'Surgelés',
            ],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }

        $this->call([
            CommandesSeeder::class,
            PromotionsSeeder::class,
        ]);
    }
}
