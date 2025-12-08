<?php

namespace App\Services;

use App\Models\Produit;
use App\Models\Promotion;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class PanierService
{
    private const SESSION_KEY = 'panier';
    private ?Collection $promotionsCache = null;

    /**
     * Obtenir le contenu du panier
     *
     * @return array<int, array{produit_id: int, libelle: string, prix_ht: string, tva: string, prix_ttc: string, quantite: int, image: string|null}>
     */
    public function getContenu(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    /**
     * Calculer les remises applicables
     *
     * @return array<string, float> ['total_remise' => float, 'details' => array]
     */
    public function calculerRemises(): array
    {
        $panier = $this->getContenu();

        if ($this->promotionsCache === null) {
            // On cache la liste des promotions pendant 1 heure (3600 secondes)
            // pour éviter de requêter la BDD à chaque calcul de panier
            $this->promotionsCache = Cache::remember('promotions_all', 3600, function () {
                return Promotion::all();
            });
        }
        $promotions = $this->promotionsCache;

        $totalRemise = 0;
        $details = [];

        foreach ($promotions as $promo) {
            // Si la promo est liée à un produit spécifique
            if ($promo->produit_id && isset($panier[$promo->produit_id])) {
                $item = $panier[$promo->produit_id];

                // Vérifier la quantité minimale
                if ($item['quantite'] >= $promo->min_quantite) {
                    $remise = 0;

                    switch ($promo->type_promo) {
                        case 'pourcentage':
                            // Remise en % sur le total de la ligne
                            $montantLigne = $item['prix_ttc'] * $item['quantite'];
                            $remise = $montantLigne * ($promo->valeur_promo / 100);
                            break;

                        case 'montant':
                            // Remise fixe par article (ou une fois ? Disons par article pour simplifier)
                            $remise = $promo->valeur_promo * $item['quantite'];
                            break;

                        case 'offert':
                            // Ex: 2 achetés = 1 offert (donc pour 3, on en paie 2)
                            // min_quantite = 3. valeur_promo = 1 (nombre offert)
                            // Combien de lots complets ?
                            $lots = floor($item['quantite'] / $promo->min_quantite);
                            $nbOfferts = $lots * $promo->valeur_promo;
                            $remise = $nbOfferts * $item['prix_ttc'];
                            break;
                    }

                    if ($remise > 0) {
                        $totalRemise += $remise;
                        // On indexe par ID produit pour l'affichage facile dans la vue
                        $details[$promo->produit_id] = [
                            'libelle_promo' => $promo->titre,
                            'remise' => $remise,
                        ];
                    }
                }
            }
        }

        return [
            'total_remise' => $totalRemise,
            'details' => $details,
        ];
    }

    /**
     * Obtenir le total TTC (avant remises)
     */
    public function getTotalTTCSansRemise(): float
    {
        $total = 0;
        foreach ($this->getContenu() as $item) {
            $total += $item['prix_ttc'] * $item['quantite'];
        }

        return $total;
    }

    /**
     * Ajouter un produit au panier
     */
    public function ajouter(int $produitId, int $quantite = 1): bool
    {
        $produit = Produit::find($produitId);

        if (! $produit || ! $produit->isEnStock()) {
            return false;
        }

        $panier = $this->getContenu();

        if (isset($panier[$produitId])) {
            $panier[$produitId]['quantite'] += $quantite;
        } else {
            $panier[$produitId] = [
                'produit_id' => $produit->id,
                'libelle' => $produit->libelle,
                'prix_ht' => $produit->prix_ht,
                'tva' => $produit->tva,
                'prix_ttc' => $produit->prix_ttc,
                'quantite' => $quantite,
                'image' => $produit->image,
            ];
        }

        // Vérifier le stock
        if ($panier[$produitId]['quantite'] > $produit->stock) {
            $panier[$produitId]['quantite'] = $produit->stock;
        }

        Session::put(self::SESSION_KEY, $panier);

        return true;
    }

    /**
     * Modifier la quantité d'un produit
     */
    public function modifier(int $produitId, int $quantite): bool
    {
        $panier = $this->getContenu();

        if (! isset($panier[$produitId])) {
            return false;
        }

        $produit = Produit::find($produitId);
        if (! $produit) {
            return false;
        }

        if ($quantite <= 0) {
            unset($panier[$produitId]);
        } else {
            $panier[$produitId]['quantite'] = min($quantite, $produit->stock);
        }

        Session::put(self::SESSION_KEY, $panier);

        return true;
    }

    /**
     * Supprimer un produit du panier
     */
    public function supprimer(int $produitId): bool
    {
        $panier = $this->getContenu();

        if (! isset($panier[$produitId])) {
            return false;
        }

        unset($panier[$produitId]);
        Session::put(self::SESSION_KEY, $panier);

        return true;
    }

    /**
     * Vider complètement le panier
     */
    public function vider(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Calculer le total HT du panier
     */
    public function getTotalHT(): float
    {
        $panier = $this->getContenu();
        $total = 0;

        foreach ($panier as $item) {
            $total += (float) $item['prix_ht'] * $item['quantite'];
        }

        return round($total, 2);
    }

    /**
     * Calculer le total TVA du panier
     */
    public function getTotalTVA(): float
    {
        $panier = $this->getContenu();
        $total = 0;

        foreach ($panier as $item) {
            $montantHT = (float) $item['prix_ht'] * $item['quantite'];
            $total += $montantHT * ((float) $item['tva'] / 100);
        }

        return round($total, 2);
    }

    /**
     * Calculer le total TTC du panier (AVEC REMISES)
     */
    public function getTotalTTC(): float
    {
        // Ancien calcul : return round($this->getTotalHT() + $this->getTotalTVA(), 2);

        // Nouveau calcul avec remises :
        $totalSansRemise = 0;
        foreach ($this->getContenu() as $item) {
            $totalSansRemise += $item['prix_ttc'] * $item['quantite'];
        }

        $remises = $this->calculerRemises();

        return max(0, round($totalSansRemise - $remises['total_remise'], 2));
    }

    /**
     * Compter le nombre d'articles dans le panier
     */
    public function getNombreArticles(): int
    {
        $panier = $this->getContenu();
        $total = 0;

        foreach ($panier as $item) {
            $total += $item['quantite'];
        }

        return $total;
    }

    /**
     * Vérifier si le panier est vide
     */
    public function estVide(): bool
    {
        return empty($this->getContenu());
    }
}
