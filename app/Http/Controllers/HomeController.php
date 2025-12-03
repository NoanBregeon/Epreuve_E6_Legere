<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        // Données pour le dashboard
        $recentOrders = collect([
            ['numero' => 'CMD-001', 'date' => now(), 'total' => 23.45, 'statut' => 'Livrée'],
            ['numero' => 'CMD-002', 'date' => now()->subDays(2), 'total' => 15.67, 'statut' => 'En préparation'],
        ]);

        return view('home', compact('user', 'recentOrders'));
    }
}
