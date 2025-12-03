@extends('layouts.app')

@section('title', 'Ajouter un produit - Admin')

@section('content')
<div class="container" style="padding: 2rem 0;">
    <div class="admin-header">
        <h2>Ajouter un nouveau produit</h2>
        <a href="{{ route('admin.index') }}" class="btn-secondary">Retour</a>
    </div>

    <div class="form-container" style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 15px; backdrop-filter: blur(10px);">
        <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="reference">Référence</label>
                <input type="text" name="reference" id="reference" class="form-control" value="{{ old('reference') }}" required>
                @error('reference') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="libelle">Libellé</label>
                <input type="text" name="libelle" id="libelle" class="form-control" value="{{ old('libelle') }}" required>
                @error('libelle') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <input type="text" name="categorie" id="categorie" class="form-control" value="{{ old('categorie') }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="form-row" style="display: flex; gap: 1rem;">
                <div class="form-group" style="flex: 1;">
                    <label for="prix_ht">Prix HT (€)</label>
                    <input type="number" step="0.01" name="prix_ht" id="prix_ht" class="form-control" value="{{ old('prix_ht') }}" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label for="tva">TVA (%)</label>
                    <input type="number" step="0.01" name="tva" id="tva" class="form-control" value="{{ old('tva', 20) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="stock">Stock initial</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', 0) }}" required>
            </div>

            <div class="form-group">
                <label for="image">Image du produit</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="actif" value="1" {{ old('actif', true) ? 'checked' : '' }}>
                    Produit actif (visible sur le site)
                </label>
            </div>

            <button type="submit" class="btn-primary">Créer le produit</button>
        </form>
    </div>
</div>
@endsection
