@extends('layouts.app')

@section('title', 'Articles Non Périssables - Drive')

@section('content')
<div class="bg-indigo-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl font-extrabold text-white sm:text-4xl">Produits Non Périssables</h1>
        <p class="mt-4 text-xl text-indigo-200">Découvrez notre sélection de produits longue conservation, stockés en toute sécurité.</p>
    </div>
</div>

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-8">
            @forelse($produits as $produit)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200 flex flex-col {{ !$produit->isEnStock() ? 'opacity-75' : '' }}">
                    <div class="relative h-48 bg-gray-200">
                        <img src="{{ $produit->image ? (Str::startsWith($produit->image, 'data:') ? $produit->image : Storage::url($produit->image)) : 'https://placehold.co/600x400?text=Produit' }}"
                             alt="{{ $produit->libelle }}"
                             class="w-full h-full object-cover">

                        <span class="absolute top-2 left-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                            {{ $produit->categorie ?? 'Produit' }}
                        </span>

                        @if(!$produit->isEnStock())
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40">
                                <span class="bg-red-600 text-white px-3 py-1 rounded font-bold uppercase text-sm tracking-wider">
                                    Rupture
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-4 flex-1 flex flex-col">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            <a href="{{ route('produits.show', $produit->id) }}" class="hover:text-indigo-600 transition-colors">
                                {{ $produit->libelle }}
                            </a>
                        </h3>

                        <p class="text-gray-500 text-sm mb-4 flex-1">
                            {{ Str::limit($produit->description, 80) ?? 'Description non renseignée.' }}
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-gray-900">
                                    {{ number_format($produit->prix_ttc, 2, ',', ' ') }} €
                                </span>
                            </div>

                            <form action="{{ route('panier.add', $produit->id) }}" method="POST" class="flex items-center gap-2" x-data="{ qty: 1, max: {{ $produit->stock }} }">
                                @csrf
                                @if($produit->isEnStock())
                                    <div class="flex items-center border border-gray-300 rounded-md">
                                        <button type="button" @click="qty > 1 ? qty-- : null" class="px-2 py-1 text-gray-600 hover:bg-gray-100 rounded-l-md focus:outline-none font-bold">-</button>
                                        <input type="number" name="quantite" x-model="qty" min="1" :max="max" class="w-12 border-0 text-center focus:ring-0 p-1 text-sm appearance-none" style="-moz-appearance: textfield;">
                                        <button type="button" @click="qty < max ? qty++ : null" class="px-2 py-1 text-gray-600 hover:bg-gray-100 rounded-r-md focus:outline-none font-bold">+</button>
                                    </div>
                                @endif
                                <button type="submit" {{ !$produit->isEnStock() ? 'disabled' : '' }}
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white {{ $produit->isEnStock() ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-gray-400 cursor-not-allowed' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ $produit->isEnStock() ? 'Ajouter' : 'Épuisé' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun produit non périssable disponible pour le moment</h3>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $produits->links() }}
        </div>

    </div>
</section>
@endsection
