<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Produit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommandesSeeder extends Seeder
{
    public function run()
    {
        // Données des commandes basées sur le script SQL fourni
        $commandesData = [
            [
                'client_id' => 1,
                'numero_commande' => 'CMD-2024-001',
                'statut' => 'A_PREPARER',
                'creneau_retrait' => Carbon::now()->addHours(2),
                'note_interne' => 'Commande urgente',
                'lignes' => [
                    ['produit_id' => 1, 'quantite_demandee' => 5, 'quantite_preparee' => 0, 'prix_unitaire_ht' => 3.99, 'statut_ligne' => 'A_VALIDER', 'note' => null],
                    ['produit_id' => 6, 'quantite_demandee' => 2, 'quantite_preparee' => 0, 'prix_unitaire_ht' => 1.45, 'statut_ligne' => 'A_VALIDER', 'note' => null],
                    ['produit_id' => 4, 'quantite_demandee' => 3, 'quantite_preparee' => 0, 'prix_unitaire_ht' => 1.05, 'statut_ligne' => 'A_VALIDER', 'note' => null],
                ]
            ],
            [
                'client_id' => 2,
                'numero_commande' => 'CMD-2024-002',
                'statut' => 'EN_PREPARATION',
                'creneau_retrait' => Carbon::now()->addDay(),
                'note_interne' => null,
                'lignes' => [
                    ['produit_id' => 2, 'quantite_demandee' => 2, 'quantite_preparee' => 2, 'prix_unitaire_ht' => 2.99, 'statut_ligne' => 'VALIDE', 'note' => null],
                    ['produit_id' => 7, 'quantite_demandee' => 4, 'quantite_preparee' => 0, 'prix_unitaire_ht' => 3.20, 'statut_ligne' => 'A_VALIDER', 'note' => null],
                    ['produit_id' => 13, 'quantite_demandee' => 1, 'quantite_preparee' => 0, 'prix_unitaire_ht' => 8.90, 'statut_ligne' => 'A_VALIDER', 'note' => null],
                ]
            ],
            [
                'client_id' => 1,
                'numero_commande' => 'CMD-2024-003',
                'statut' => 'PREPAREE',
                'creneau_retrait' => Carbon::now()->subDays(2),
                'note_interne' => 'Client VIP',
                'lignes' => [
                    ['produit_id' => 3, 'quantite_demandee' => 6, 'quantite_preparee' => 6, 'prix_unitaire_ht' => 1.89, 'statut_ligne' => 'VALIDE', 'note' => null],
                    ['produit_id' => 8, 'quantite_demandee' => 2, 'quantite_preparee' => 2, 'prix_unitaire_ht' => 2.80, 'statut_ligne' => 'VALIDE', 'note' => null],
                ]
            ],
            [
                'client_id' => 2,
                'numero_commande' => 'CMD-2024-004',
                'statut' => 'LIVREE',
                'creneau_retrait' => Carbon::now()->subDay(),
                'note_interne' => null,
                'lignes' => [
                    ['produit_id' => 5, 'quantite_demandee' => 2, 'quantite_preparee' => 2, 'prix_unitaire_ht' => 2.50, 'statut_ligne' => 'VALIDE', 'note' => null],
                    ['produit_id' => 9, 'quantite_demandee' => 3, 'quantite_preparee' => 3, 'prix_unitaire_ht' => 1.80, 'statut_ligne' => 'VALIDE', 'note' => null],
                    ['produit_id' => 10, 'quantite_demandee' => 1, 'quantite_preparee' => 1, 'prix_unitaire_ht' => 3.50, 'statut_ligne' => 'VALIDE', 'note' => null],
                ]
            ],
            [
                'client_id' => 1,
                'numero_commande' => 'CMD-2024-005',
                'statut' => 'A_PREPARER',
                'creneau_retrait' => Carbon::now()->addHours(4),
                'note_interne' => 'Attention produits frais',
                'lignes' => [
                    ['produit_id' => 14, 'quantite_demandee' => 2, 'quantite_preparee' => 0, 'prix_unitaire_ht' => 7.50, 'statut_ligne' => 'A_VALIDER', 'note' => null],
                    ['produit_id' => 15, 'quantite_demandee' => 3, 'quantite_preparee' => 0, 'prix_unitaire_ht' => 3.99, 'statut_ligne' => 'A_VALIDER', 'note' => null],
                    ['produit_id' => 12, 'quantite_demandee' => 1, 'quantite_preparee' => 0, 'prix_unitaire_ht' => 3.50, 'statut_ligne' => 'RUPTURE', 'note' => 'Produit manquant en rayon'],
                ]
            ],
        ];

        foreach ($commandesData as $data) {
            $lignes = $data['lignes'];
            unset($data['lignes']);

            // Calcul des totaux
            $total_ht = 0;
            $total_ttc = 0;

            foreach ($lignes as $ligne) {
                $produit = Produit::find($ligne['produit_id']);
                $tva = $produit ? $produit->tva : 20; // Valeur par défaut si produit non trouvé

                $ht = $ligne['quantite_demandee'] * $ligne['prix_unitaire_ht'];
                $ttc = $ht * (1 + $tva / 100);

                $total_ht += $ht;
                $total_ttc += $ttc;
            }

            $data['total_ht'] = $total_ht;
            $data['total_ttc'] = $total_ttc;

            // Création de la commande
            $commande = Commande::updateOrCreate(
                ['numero_commande' => $data['numero_commande']],
                $data
            );

            // Supprimer les lignes existantes pour éviter les doublons si le seeder est relancé
            $commande->lignes()->delete();

            // Création des lignes
            foreach ($lignes as $ligne) {
                $ligne['commande_id'] = $commande->id;
                LigneCommande::create($ligne);
            }
        }
    }
}
