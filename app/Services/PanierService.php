<?php

namespace App\Services;

use App\Models\Produit;
use Illuminate\Support\Facades\Session;

class PanierService
{
    private const SESSION_KEY = 'panier';

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
     * Calculer le total TTC du panier
     */
    public function getTotalTTC(): float
    {
        return round($this->getTotalHT() + $this->getTotalTVA(), 2);
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
