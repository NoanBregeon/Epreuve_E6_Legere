@extends('layouts.app')

@section('title', 'Produits - Drive')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Tous les produits</h1>
        <p class="page-subtitle">Consultez les produits disponibles sur le Drive.</p>
    </div>
</div>

<section class="content-section">
    <div class="container">
        <!-- Filtres et Recherche -->
        <div class="filters-bar" style="margin-bottom: 2rem; background: #f8f9fa; padding: 1rem; border-radius: 8px;">
            <form action="{{ route('produits.index') }}" method="GET" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                <div style="flex: 1; min-width: 200px;">
                    <input type="text" name="search" placeholder="Rechercher un produit..." value="{{ request('search') }}" class="form-control" style="width: 100%;">
                </div>

                <div style="min-width: 150px;">
                    <select name="categorie" class="form-control" style="width: 100%;" onchange="this.form.submit()">
                        <option value="">Toutes catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('categorie') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="min-width: 150px;">
                    <select name="sort" class="form-control" style="width: 100%;" onchange="this.form.submit()">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nom (A-Z)</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                    </select>
                </div>

                <div style="display: flex; align-items: center;">
                    <input type="checkbox" name="in_stock" id="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }} onchange="this.form.submit()">
                    <label for="in_stock" style="margin-left: 0.5rem; margin-bottom: 0;">En stock</label>
                </div>

                <button type="submit" class="btn-primary">Filtrer</button>
                @if(request()->anyFilled(['search', 'categorie', 'sort', 'in_stock']))
                    <a href="{{ route('produits.index') }}" class="btn-secondary">Réinitialiser</a>
                @endif
            </form>
        </div>

        <div class="products-grid">
            @forelse($produits as $produit)
                <div class="product-card" style="{{ !$produit->isEnStock() ? 'opacity: 0.8;' : '' }}">
                    <div class="product-card-header" style="background-image: url('{{ $produit->image ? (Str::startsWith($produit->image, 'data:') ? $produit->image : Storage::url($produit->image)) : 'https://placehold.co/600x400?text=Produit' }}'); background-size: cover; background-position: center; height: 200px; position: relative;">
                        <span class="product-category" style="position: absolute; top: 10px; left: 10px;">
                            {{ $produit->categorie ?? 'Produit' }}
                        </span>
                        @if(!$produit->isEnStock())
                            <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(220, 53, 69, 0.9); color: white; padding: 0.5rem 1rem; font-weight: bold; border-radius: 4px; text-transform: uppercase;">
                                Rupture
                            </span>
                        @endif
                    </div>

                    <div class="product-card-body">
                        <h3 class="product-name">
                            <a href="{{ route('produits.show', $produit->id) }}">
                                {{ $produit->libelle }}
                            </a>
                        </h3>

                        <p class="product-description">
                            {{ Str::limit($produit->description, 80) ?? 'Description non renseignée.' }}
                        </p>
                        <p class="product-price">
                            {{ number_format($produit->prix_ttc, 2, ',', ' ') }} € TTC
                        </p>
                    </div>

                    <div class="product-card-footer">
                        <form action="{{ route('panier.add', $produit->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-primary" {{ !$produit->isEnStock() ? 'disabled' : '' }} style="{{ !$produit->isEnStock() ? 'background-color: #6c757d; border-color: #6c757d; cursor: not-allowed;' : '' }}">
                                {{ $produit->isEnStock() ? 'Ajouter au panier' : 'Indisponible' }}
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                    <p>Aucun produit ne correspond à votre recherche.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination-container" style="margin-top: 2rem; display: flex; justify-content: center;">
            {{ $produits->appends(request()->query())->links() }}
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('accueil') }}" class="btn-secondary">
                Retour à l’accueil
            </a>
        </div>
    </div>
</section>
@endsection
