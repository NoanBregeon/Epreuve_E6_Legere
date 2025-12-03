@extends('layouts.app')

@section('title', $produit->libelle . ' - Drive')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">{{ $produit->libelle }}</h1>
        <p class="page-subtitle">Détail du produit</p>
    </div>
</div>

<section class="content-section">
    <div class="container">
        <div class="product-detail-card">
            <h2>{{ $produit->libelle }}</h2>

            @if($produit->description)
                <p style="margin-bottom: 1rem;">
                    {{ $produit->description }}
                </p>
            @endif

            <p class="product-price">
                {{ number_format($produit->prix_ttc, 2, ',', ' ') }} € TTC
                <span style="font-size: 0.85rem; opacity: .8;">
                    ({{ number_format($produit->prix_ht, 2, ',', ' ') }} € HT, TVA {{ $produit->tva }} %)
                </span>
            </p>

            <p>Stock disponible : {{ $produit->stock }}</p>

            <form action="{{ route('panier.add', $produit->id) }}" method="POST" style="margin-top: 1.5rem;">
                @csrf
                <button type="submit" class="btn-primary">
                    Ajouter au panier
                </button>
            </form>

            <div style="margin-top: 1.5rem;">
                <a href="{{ route('produits.index') }}" class="btn-secondary">
                    Retour aux produits
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
