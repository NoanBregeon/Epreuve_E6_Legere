@extends('layouts.app')

@section('title', 'Administration - Drive')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Administration</h1>
        <p class="page-subtitle">Gestion des produits et commandes</p>
    </div>
</div>

<section class="content-section">
    <div class="container">
        <div class="admin-layout">
            <!-- Admin Sidebar -->
            <aside class="admin-sidebar">
                <nav class="admin-nav">
                    <a href="/admin" class="admin-nav-link active">
                        <span class="nav-icon">📊</span>
                        Tableau de bord
                    </a>
                    <a href="/admin/produits" class="admin-nav-link">
                        <span class="nav-icon">📦</span>
                        Produits
                    </a>
                    <a href="/admin/commandes" class="admin-nav-link">
                        <span class="nav-icon">🛒</span>
                        Commandes
                    </a>
                    <a href="/admin/clients" class="admin-nav-link">
                        <span class="nav-icon">👥</span>
                        Clients
                    </a>
                    <a href="/admin/statistiques" class="admin-nav-link">
                        <span class="nav-icon">📈</span>
                        Statistiques
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="admin-main">
                <div class="admin-header">
                    <h2>Derniers produits ajoutés</h2>
                    <a href="/admin/produits/create" class="btn-primary">Ajouter un produit</a>
                </div>

                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prix TTC</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestProduits as $produit)
                            <tr>
                                <td>{{ $produit->id }}</td>
                                <td>{{ $produit->libelle }}</td>
                                <td>{{ number_format($produit->prix_ttc, 2, ',', ' ') }} €</td>
                                <td class="{{ $produit->stock == 0 ? 'stock-out' : ($produit->stock < 10 ? 'stock-low' : 'stock-ok') }}">
                                    {{ $produit->stock }}
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action btn-edit" title="Modifier">✏️</button>
                                        <button class="btn-action btn-delete" title="Supprimer">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="admin-stats">
                    <div class="stat-card">
                        <h3>Total produits</h3>
                        <div class="stat-value">{{ $stats['produits_count'] }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Total Commandes</h3>
                        <div class="stat-value">{{ $stats['commandes_count'] }}</div>
                    </div>
                    <div class="stat-card">
                        <h3>Chiffre d'affaires</h3>
                        <div class="stat-value">{{ number_format($stats['chiffre_affaires'], 2, ',', ' ') }} €</div>
                    </div>
                    <div class="stat-card">
                        <h3>Clients inscrits</h3>
                        <div class="stat-value">{{ $stats['clients_count'] }}</div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>
@endsection
