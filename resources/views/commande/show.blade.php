@extends('layouts.app')

@section('title', 'Détail Commande - Drive')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Commande #{{ $commande->numero_commande ?? $commande->id }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Passée le {{ $commande->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('commande.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Retour à mes commandes
                </a>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Liste des produits -->
            <div class="flex-1">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Articles commandés
                        </h3>
                    </div>
                    <ul class="divide-y divide-gray-200">
                        @foreach($commande->lignes as $ligne)
                        <li class="px-4 py-4 sm:px-6 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 rounded-md border border-gray-200 overflow-hidden">
                                    @if($ligne->produit->image)
                                        <img src="{{ Str::startsWith($ligne->produit->image, 'data:') ? $ligne->produit->image : asset('storage/' . $ligne->produit->image) }}" alt="{{ $ligne->produit->libelle }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gray-100 flex items-center justify-center text-gray-400 text-xs font-bold">
                                            {{ substr($ligne->produit->libelle, 0, 2) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $ligne->produit->libelle }}</div>
                                    <div class="text-sm text-gray-500">Ref: {{ $ligne->produit->reference }}</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-8">
                                <div class="text-sm text-gray-500">
                                    {{ number_format($ligne->prix_unitaire_ht * (1 + $ligne->produit->tva/100), 2, ',', ' ') }} € x {{ $ligne->quantite_demandee }}
                                </div>
                                <div class="text-sm font-bold text-gray-900">
                                    {{ number_format($ligne->quantite_demandee * $ligne->prix_unitaire_ht * (1 + $ligne->produit->tva/100), 2, ',', ' ') }} €
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Infos Commande -->
            <div class="w-full lg:w-1/3 space-y-6">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Informations
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6 space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Statut</h4>
                            <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $commande->statut === 'VALIDE' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $commande->statut }}
                            </span>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Total Commande</h4>
                            <p class="mt-1 text-2xl font-bold text-indigo-600">
                                {{ number_format($commande->lignes->sum(function($l) { return $l->quantite_demandee * $l->prix_unitaire_ht * (1 + $l->produit->tva/100); }), 2, ',', ' ') }} €
                            </p>
                        </div>

                        @if($commande->creneau_retrait)
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Créneau de retrait</h4>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($commande->creneau_retrait)->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
