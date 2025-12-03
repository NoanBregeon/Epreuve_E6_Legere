<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Ticket;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stats = [
            'produits_count' => Produit::count(),
            'commandes_count' => Ticket::count(),
            'clients_count' => User::count(),
            'chiffre_affaires' => Ticket::sum('total_ttc'),
        ];

        $latestProduits = Produit::latest()->take(5)->get();

        return view('admin.index', compact('stats', 'latestProduits'));
    }
}
