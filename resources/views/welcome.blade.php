@extends('layouts.app')

@section('title', 'Accueil - Drive E6')

@section('content')
    <!-- Hero Section (Promotional Banner) -->
    <div class="relative bg-cyan-800 overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover opacity-30" src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" alt="Supermarché">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-900 via-cyan-800 to-transparent mix-blend-multiply"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Bienvenue !
            </h1>
            <p class="mt-6 text-xl text-cyan-100 max-w-3xl">
                Retrouvez tous vos produits préférés au meilleur prix. Commandez en ligne et récupérez vos courses en 5 minutes au Drive.
            </p>
            <div class="mt-10 flex gap-4">
                <a href="{{ route('produits.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-cyan-700 bg-white hover:bg-cyan-50 shadow-lg transition-transform transform hover:scale-105">
                    Commencer mes courses
                </a>
                @if($promotions->isNotEmpty())
                <a href="{{ route('promotions.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 shadow-lg transition-transform transform hover:scale-105">
                    Voir les promotions
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Reassurance Strip (Key Figures) -->
    <div class="bg-cyan-600">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="flex items-center justify-center md:justify-start">
                    <div class="flex-shrink-0">
                        <span class="text-4xl font-bold text-white">{{ $produitsCount }}</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-lg font-medium text-cyan-100">Produits</p>
                        <p class="text-sm text-cyan-200">Disponibles en magasin</p>
                    </div>
                </div>
                <div class="flex items-center justify-center md:justify-start border-t md:border-t-0 md:border-l border-cyan-500 pt-4 md:pt-0 md:pl-8">
                    <div class="flex-shrink-0">
                        <span class="text-4xl font-bold text-white">100%</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-lg font-medium text-cyan-100">Frais</p>
                        <p class="text-sm text-cyan-200">Qualité garantie</p>
                    </div>
                </div>
                <div class="flex items-center justify-center md:justify-start border-t md:border-t-0 md:border-l border-cyan-500 pt-4 md:pt-0 md:pl-8">
                    <div class="flex-shrink-0">
                        <span class="text-4xl font-bold text-white">24/7</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-lg font-medium text-cyan-100">Commande</p>
                        <p class="text-sm text-cyan-200">Site accessible tout le temps</p>
                    </div>
                </div>
                <div class="flex items-center justify-center md:justify-start border-t md:border-t-0 md:border-l border-cyan-500 pt-4 md:pt-0 md:pl-8">
                    <div class="flex-shrink-0">
                        <span class="text-4xl font-bold text-white">0€</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-lg font-medium text-cyan-100">Frais</p>
                        <p class="text-sm text-cyan-200">Préparation gratuite</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Promotions Section -->
    @if($promotions->isNotEmpty())
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Les promos dans votre magasin</h2>
                <a href="{{ route('produits.index') }}" class="text-cyan-600 hover:text-cyan-800 font-medium">Voir tout ></a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($promotions as $promo)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-48 bg-gray-200 relative">
                        <img src="{{ $promo->image_path }}" alt="{{ $promo->titre }}" class="w-full h-full object-cover">
                        @if($promo->badge_text)
                            <span class="absolute top-2 left-2 {{ $promo->badge_color == 'red' ? 'bg-red-600' : 'bg-cyan-600' }} text-white text-xs font-bold px-2 py-1 rounded">{{ $promo->badge_text }}</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $promo->titre }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $promo->description }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="{{ $promo->badge_color == 'red' ? 'text-red-600' : 'text-gray-900' }} font-bold text-lg">{{ $promo->prix_affichage }}</span>
                            @if($promo->produit_id)
                                <a href="{{ route('produits.show', $promo->produit_id) }}" class="text-cyan-600 font-medium hover:underline">{{ $promo->texte_bouton }}</a>
                            @else
                                <a href="{{ $promo->lien_url }}" class="text-cyan-600 font-medium hover:underline">{{ $promo->texte_bouton }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Services Section -->
    <div class="py-12 bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-10">
                <h2 class="text-base text-cyan-600 font-semibold tracking-wide uppercase">Services</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Pourquoi choisir notre Drive ?
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-cyan-500 text-white">
                                <!-- Heroicon name: outline/globe-alt -->
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Retrait rapide</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Récupérez vos courses sans sortir de votre voiture. Nous chargeons votre coffre en 5 minutes.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-cyan-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Paiement sécurisé</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Vos données bancaires sont protégées. Payez en ligne ou lors du retrait.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-cyan-500 text-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Produits frais garantis</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Nous sélectionnons pour vous les meilleurs produits. Fraîcheur et qualité assurées.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
