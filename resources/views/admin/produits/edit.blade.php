@extends('layouts.app')

@section('title', 'Modifier le produit - Admin')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <div class="admin-header">
        <h2>Modifier le produit : {{ $produit->libelle }}</h2>
        <a href="{{ route('admin.index') }}" class="btn-secondary">Retour</a>
    </div>

    <div class="form-container" style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 15px; backdrop-filter: blur(10px);">
        <form action="{{ route('produits.update', $produit) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="reference">Référence</label>
                <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference', $produit->reference) }}" required>
                @error('reference') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="libelle">Libellé</label>
                <input type="text" name="libelle" id="libelle" class="form-control" value="{{ old('libelle', $produit->libelle) }}" required>
                @error('libelle') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <input type="text" name="categorie" id="categorie" class="form-control" value="{{ old('categorie', $produit->categorie) }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $produit->description) }}</textarea>
            </div>

            <div class="form-row" style="display: flex; gap: 1rem;">
                <div class="form-group" style="flex: 1;">
                    <label for="prix_ht">Prix HT (€)</label>
                    <input type="number" step="0.01" name="prix_ht" id="prix_ht" class="form-control" value="{{ old('prix_ht', $produit->prix_ht) }}" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label for="tva">TVA (%)</label>
                    <input type="number" step="0.01" name="tva" id="tva" class="form-control" value="{{ old('tva', $produit->tva) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $produit->stock) }}" required>
            </div>

            <div class="form-group">
                <label for="image">Image du produit</label>
                @if($produit->image)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ Str::startsWith($produit->image, 'data:') ? $produit->image : asset('storage/' . $produit->image) }}" alt="Image actuelle" style="max-height: 100px; border-radius: 5px;">
                        <p class="text-muted" style="font-size: 0.8rem;">Image actuelle</p>
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="actif" value="1" {{ old('actif', $produit->actif) ? 'checked' : '' }}>
                    Produit actif (visible sur le site)
                </label>
            </div>

            <button type="submit" class="btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
