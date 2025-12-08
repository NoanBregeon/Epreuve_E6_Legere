@extends('layouts.app')

@section('title', $produit->libelle . ' - Drive')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Image du produit -->
                <div class="md:w-1/2 bg-gray-200 h-96 md:h-auto relative">
                    <img src="{{ $produit->image ? (Str::startsWith($produit->image, 'data:') ? $produit->image : Storage::url($produit->image)) : 'https://placehold.co/600x400?text=Produit' }}"
                         alt="{{ $produit->libelle }}"
                         class="w-full h-full object-cover object-center">

                    @if(!$produit->isEnStock())
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40">
                            <span class="bg-red-600 text-white px-4 py-2 rounded-md font-bold uppercase text-lg tracking-wider">
                                Rupture de stock
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Détails du produit -->
                <div class="md:w-1/2 p-8 flex flex-col">
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-cyan-600 font-semibold tracking-wide uppercase">
                                    {{ $produit->categorie ?? 'Produit' }}
                                </p>
                                <h1 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                                    {{ $produit->libelle }}
                                </h1>
                            </div>
                            @if($produit->promotions->isNotEmpty())
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                    En Promo
                                </span>
                            @endif
                        </div>

                        <div class="mt-6 prose prose-cyan text-gray-500">
                            <p>{{ $produit->description ?? 'Aucune description disponible pour ce produit.' }}</p>
                        </div>

                        <div class="mt-8 border-t border-gray-200 pt-8">
                            <div class="flex items-baseline">
                                <p class="text-3xl font-extrabold text-gray-900">
                                    {{ number_format($produit->prix_ttc, 2, ',', ' ') }} €
                                </p>
                                <p class="ml-2 text-sm text-gray-500">TTC</p>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ number_format($produit->prix_ht, 2, ',', ' ') }} € HT (TVA {{ $produit->tva }}%)
                            </p>
                        </div>

                        <div class="mt-4 flex items-center">
                            @if($produit->isEnStock())
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p class="ml-2 text-sm text-gray-700">
                                    En stock ({{ $produit->stock }} disponibles)
                                </p>
                            @else
                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <p class="ml-2 text-sm text-red-600">
                                    Actuellement indisponible
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <form action="{{ route('panier.add', $produit->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" {{ !$produit->isEnStock() ? 'disabled' : '' }}
                                class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white {{ $produit->isEnStock() ? 'bg-cyan-600 hover:bg-cyan-700' : 'bg-gray-400 cursor-not-allowed' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 md:py-4 md:text-lg shadow-sm">
                                {{ $produit->isEnStock() ? 'Ajouter au panier' : 'Rupture de stock' }}
                            </button>
                        </form>

                        <a href="{{ route('produits.index') }}" class="flex-1 w-full flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 md:py-4 md:text-lg">
                            Retour aux produits
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
