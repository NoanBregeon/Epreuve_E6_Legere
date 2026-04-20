<?php

namespace App\Services;

use App\Models\Produit;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FnacDartyService
{
    /**
     * Map a local product to the Fnac Darty marketplace format.
     *
     * @param Produit $produit
     * @return array
     */
    public function mapProduct(Produit $produit): array
    {
        return [
            'sku' => $produit->reference,
            'product_title' => $produit->libelle,
            'price' => $produit->prix_ht,
            'quantity' => $produit->stock,
            'description' => $produit->description,
            'category' => $produit->fnacdarty_category,
        ];
    }

    /**
     * Export a product to the Fnac Darty mock API.
     *
     * @param Produit $produit
     * @return array
     */
    public function export(Produit $produit): array
    {
        $mappedData = $this->mapProduct($produit);

        try {
            // Using absolute URL to support the simulation
            $response = Http::post(url('/api/fnacdarty/mock'), $mappedData);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => $response->json('message', 'Export réussi'),
                ];
            }

            return [
                'success' => false,
                'message' => 'Erreur lors de l\'export : ' . $response->status(),
            ];
        } catch (\Exception $e) {
            Log::error('Erreur d\'export Fnac Darty : ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Impossible de joindre l\'API Fnac Darty simulée.',
            ];
        }
    }
}
