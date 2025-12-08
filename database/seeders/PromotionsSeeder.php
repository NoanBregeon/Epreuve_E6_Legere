<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Promo 1 : Café (On va dire que c'est le produit ID 1 pour l'exemple, ou null si pas de produit café)
        // Pour l'exemple, on va créer un produit Café s'il n'existe pas, ou utiliser un existant.
        // Dans le doute, on met null pour produit_id et on dit que c'est une info pour l'instant,
        // ou on l'associe au produit 1 (Pommes) pour tester la réduction.
        // Disons que la promo "Sélection Café" est en fait sur les "Pommes Bio" pour le test technique.
        Promotion::create([
            'titre' => 'Sélection Café',
            'description' => 'Sur toute la gamme de cafés en grains.',
            'image_path' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'badge_text' => '-30%',
            'badge_color' => 'red',
            'prix_affichage' => 'Dès 4,99 €',
            'texte_bouton' => "J'en profite",
            'lien_url' => '#',
            'produit_id' => null, // Pas de produit café dans la BDD actuelle
            'type_promo' => 'info',
            'valeur_promo' => 0,
        ]);

        // Promo 2 : Légumes (2+1 offert sur les Tomates ID 2)
        Promotion::create([
            'titre' => 'Légumes de saison',
            'description' => "Pour l'achat de 2 kilos de tomates, le 3ème offert.",
            'image_path' => 'https://images.unsplash.com/photo-1597362925123-77861d3fbac7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'badge_text' => '2+1 OFFERT',
            'badge_color' => 'red',
            'prix_affichage' => '2,50 € / kg',
            'texte_bouton' => "J'en profite",
            'lien_url' => '#',
            'produit_id' => 2, // Tomates en Grappe
            'type_promo' => 'offert', // 2 achetés = 1 offert (donc pour 3 articles, on en paie 2)
            'valeur_promo' => 1, // Nombre offert
            'min_quantite' => 3, // Il faut en prendre 3 pour déclencher
        ]);

        // Promo 3 : Bio (Remise 10% sur le Lait Bio ID 6)
        Promotion::create([
            'titre' => 'Rayon Bio',
            'description' => 'Découvrez notre nouvelle gamme de produits bio. -10% sur le lait.',
            'image_path' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            'badge_text' => 'NOUVEAU',
            'badge_color' => 'cyan',
            'prix_affichage' => 'Dès 1,99 €',
            'texte_bouton' => 'Découvrir',
            'lien_url' => '#',
            'produit_id' => 6, // Lait Bio
            'type_promo' => 'pourcentage',
            'valeur_promo' => 10, // 10%
            'min_quantite' => 1,
        ]);
    }
}
