<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduitRequest;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Produit::where('actif', true);

        // Recherche
        if ($request->filled('search')) {
            $query->where('libelle', 'like', '%'.$request->search.'%');
        }

        // Filtre par catégorie
        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // Filtre par stock
        if ($request->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Tri
        if ($request->filled('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('prix_ht', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('prix_ht', 'desc');
            } else {
                $query->orderBy('libelle');
            }
        } else {
            $query->orderBy('libelle');
        }

        $produits = $query->paginate(12)->withQueryString();

        // Récupérer les catégories pour le filtre
        $categories = Produit::where('actif', true)->distinct()->pluck('categorie')->filter();

        return view('produits.index', compact('produits', 'categories'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $produit = Produit::where('actif', true)->findOrFail($id);

        return view('produits.show', compact('produit'));
    }

    // --- Méthodes Admin ---

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.produits.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProduitRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('produits', 'public');
            $data['image'] = $path;
        }

        Produit::create($data);

        return redirect()->route('admin.index')->with('success', 'Produit créé avec succès.');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function edit(Produit $produit)
    {
        return view('admin.produits.edit', compact('produit'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreProduitRequest $request, Produit $produit)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
            $path = $request->file('image')->store('produits', 'public');
            $data['image'] = $path;
        }

        $produit->update($data);

        return redirect()->route('admin.index')->with('success', 'Produit mis à jour.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('admin.index')->with('success', 'Produit supprimé.');
    }
}
