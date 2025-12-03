<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProduitRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Seuls les admins peuvent créer/modifier des produits
        return Auth::check() && Auth::user()->isAdmin();
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        // On récupère l'ID du produit si on est en modification (pour ignorer l'unicité de la ref sur soi-même)
        /** @var \App\Models\Produit|null $produit */
        $produit = $this->route('produit');
        $produitId = $produit ? $produit->id : null;

        return [
            'reference' => 'required|string|max:50|unique:produits,reference,'.$produitId,
            'libelle' => 'required|string|max:150',
            'description' => 'nullable|string',
            'prix_ht' => 'required|numeric|min:0',
            'tva' => 'required|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'categorie' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB
            'actif' => 'boolean',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'reference.required' => 'La référence est obligatoire.',
            'reference.unique' => 'Cette référence existe déjà.',
            'prix_ht.min' => 'Le prix ne peut pas être négatif.',
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
            'image.image' => 'Le fichier doit être une image.',
        ];
    }
}
