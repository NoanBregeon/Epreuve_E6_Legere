<?php

namespace App\Http\Controllers;

use App\Services\PanierService;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    protected PanierService $panierService;

    public function __construct(PanierService $panierService)
    {
        $this->panierService = $panierService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $panier = $this->panierService->getContenu();
        $totalHT = $this->panierService->getTotalHT();
        $totalTVA = $this->panierService->getTotalTVA();
        $totalTTC = $this->panierService->getTotalTTC();
        $nombreArticles = $this->panierService->getNombreArticles();

        // Récupérer les détails des remises pour l'affichage
        $remises = $this->panierService->calculerRemises();

        return view('panier.index', compact('panier', 'totalHT', 'totalTVA', 'totalTTC', 'nombreArticles', 'remises'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, int $id)
    {
        $quantite = $request->input('quantite', 1);

        if ($this->panierService->ajouter($id, $quantite)) {
            return redirect()->back()
                ->with('success', 'Produit ajouté au panier avec succès !');
        }

        return redirect()->back()
            ->with('error', 'Impossible d\'ajouter ce produit au panier.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:0',
        ]);

        if ($this->panierService->modifier($id, $request->quantite)) {
            return redirect()->route('panier.index')
                ->with('success', 'Panier mis à jour !');
        }

        return redirect()->back()
            ->with('error', 'Impossible de modifier le panier.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(int $id)
    {
        if ($this->panierService->supprimer($id)) {
            return redirect()->route('panier.index')
                ->with('success', 'Article supprimé du panier.');
        }

        return redirect()->back()
            ->with('error', 'Impossible de supprimer cet article.');
    }
}
