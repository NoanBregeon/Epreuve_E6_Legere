@extends('layouts.app')

@section('title', 'Mon panier - Drive')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Mon panier
            </h1>
            <p class="mt-4 text-lg text-gray-500">
                Vérifiez vos articles avant de passer commande
            </p>
        </div>

        @if(count($panier) > 0)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <ul class="divide-y divide-gray-200">
                    @foreach($panier as $id => $item)
                    <li class="p-4 sm:p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center flex-1">
                            <div class="flex-shrink-0 h-20 w-20 border border-gray-200 rounded-md overflow-hidden">
                                @if(isset($item['image']) && $item['image'])
                                    <img src="{{ Str::startsWith($item['image'], 'data:') ? $item['image'] : asset('storage/' . $item['image']) }}" alt="{{ $item['libelle'] }}" class="h-full w-full object-cover object-center">
                                @else
                                    <div class="h-full w-full bg-gray-100 flex items-center justify-center text-gray-400 font-bold text-xl">
                                        {{ substr($item['libelle'], 0, 2) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-6 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">{{ $item['libelle'] }}</h3>
                                <p class="mt-1 text-sm text-gray-500">Prix unitaire: {{ number_format($item['prix_ttc'], 2, ',', ' ') }} € TTC</p>
                            </div>
                        </div>

                        <div class="mt-4 sm:mt-0 flex items-center justify-between sm:justify-end space-x-6">
                            <!-- Quantité -->
                            <form action="{{ route('panier.update', $id) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <label for="quantite-{{ $id }}" class="sr-only">Quantité</label>
                                <input type="number" id="quantite-{{ $id }}" name="quantite" value="{{ $item['quantite'] }}" min="1" class="w-20 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2 border" onchange="this.form.submit()">
                            </form>

                            <!-- Total Ligne -->
                            <div class="text-lg font-bold text-gray-900 w-24 text-right">
                                {{ number_format($item['prix_ttc'] * $item['quantite'], 2, ',', ' ') }} €
                            </div>

                            <!-- Supprimer -->
                            <form action="{{ route('panier.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 p-2">
                                    <span class="sr-only">Supprimer</span>
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <div class="bg-gray-50 px-4 py-5 sm:px-6 flex flex-col sm:flex-row justify-between items-center">
                    <div class="text-base font-medium text-gray-900 mb-4 sm:mb-0">
                        <a href="{{ route('produits.index') }}" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Continuer mes achats
                        </a>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <div class="text-2xl font-bold text-gray-900">
                            Total: {{ number_format($totalTTC, 2, ',', ' ') }} €
                        </div>
                        <a href="{{ route('commande.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Valider mon panier
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12 bg-white shadow sm:rounded-lg">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Votre panier est vide</h3>
                <p class="mt-1 text-sm text-gray-500">Commencez par ajouter des produits.</p>
                <div class="mt-6">
                    <a href="{{ route('produits.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Voir les produits
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
