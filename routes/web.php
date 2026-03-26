<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ProfileController;
use App\Models\Produit;
use App\Models\Promotion;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $produitsCount = Produit::count();
    $promotions = Promotion::all();

    return view('welcome', compact('produitsCount', 'promotions'));
})->name('accueil');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Routes Application Drive ---

// Produits
Route::get('/produits', [ProduitsController::class, 'index'])->name('produits.index');
Route::get('/promotions', [ProduitsController::class, 'promotions'])->name('promotions.index');
Route::get('/produits/{id}', [ProduitsController::class, 'show'])->name('produits.show');

// Panier
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('/panier/{id}/ajouter', [PanierController::class, 'add'])->name('panier.add');
Route::patch('/panier/{id}', [PanierController::class, 'update'])->name('panier.update');
Route::delete('/panier/{id}', [PanierController::class, 'remove'])->name('panier.remove');

// Commandes (nécessite auth)
Route::middleware('auth')->group(function () {
    Route::get('/commande/create', [CommandeController::class, 'create'])->name('commande.create'); // Page de finalisation
    Route::post('/commande', [CommandeController::class, 'store'])->name('commande.store'); // Valider panier
    Route::get('/commande', [CommandeController::class, 'index'])->name('commande.index'); // Liste des commandes
});

// Commandes (Public / Guest)
Route::get('/commande/{id}', [CommandeController::class, 'show'])->name('commande.show'); // Détail commande
Route::get('/commande/confirmation/{id}', [CommandeController::class, 'confirmation'])->name('commande.confirmation');



require __DIR__.'/auth.php';
