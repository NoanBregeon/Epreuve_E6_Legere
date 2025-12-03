@extends('layouts.app')

@section('title', 'Tableau de bord - Drive')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Bienvenue {{ auth()->user()->name ?? 'Utilisateur' }}</h1>
        <p class="page-subtitle">Votre espace personnel Drive</p>
    </div>
</div>

<section class="content-section">
    <div class="container">
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-icon">🛒</div>
                <h3>Faire mes courses</h3>
                <p>Découvrez notre catalogue de produits frais</p>
                <a href="/produits" class="btn-primary">Voir les produits</a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">📦</div>
                <h3>Mes commandes</h3>
                <p>Suivez l'état de vos commandes en cours</p>
                <a href="/mes-commandes" class="btn-primary">Voir mes commandes</a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">👤</div>
                <h3>Mon profil</h3>
                <p>Gérez vos informations personnelles</p>
                <a href="/profil" class="btn-primary">Modifier mon profil</a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">🎯</div>
                <h3>Mes favoris</h3>
                <p>Retrouvez vos produits préférés</p>
                <a href="/favoris" class="btn-primary">Voir mes favoris</a>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="recent-section">
            <h2>Mes dernières commandes</h2>
            <div class="orders-list">
                <div class="order-item">
                    <div class="order-info">
                        <span class="order-number">#CMD-001</span>
                        <span class="order-date">{{ date('d/m/Y') }}</span>
                    </div>
                    <div class="order-status status-delivered">Livrée</div>
                    <div class="order-total">23,45 €</div>
                </div>
                <div class="order-item">
                    <div class="order-info">
                        <span class="order-number">#CMD-002</span>
                        <span class="order-date">{{ date('d/m/Y', strtotime('-2 days')) }}</span>
                    </div>
                    <div class="order-status status-preparing">En préparation</div>
                    <div class="order-total">15,67 €</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
