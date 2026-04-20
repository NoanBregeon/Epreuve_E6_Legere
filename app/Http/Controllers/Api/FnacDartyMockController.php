<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FnacDartyMockController extends Controller
{
    /**
     * Handle the incoming mock API request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // En conditions réelles, on validerait les données ici
        $data = $request->all();

        // On simule un traitement réussi
        return response()->json([
            'status' => 'success',
            'message' => 'Produit simulé envoyé',
            'received' => [
                'sku' => $data['sku'] ?? null,
                'title' => $data['product_title'] ?? null,
            ]
        ], 200);
    }
}
