@extends('layouts.app')

@section('title', 'Accueil - Drive')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-indigo-800 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-indigo-800 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Faites vos courses en ligne</span>
                            <span class="block text-indigo-400 xl:inline">simplement et rapidement</span>
                        </h1>
                        <p class="mt-3 text-base text-indigo-200 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Commandez en quelques clics et récupérez votre panier au Drive. Profitez de produits frais et de qualité sans perdre de temps.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('produits.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 md:py-4 md:text-lg md:px-10">
                                    Découvrir les produits
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1567&q=80" alt="Supermarché">
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Services</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Pourquoi choisir notre Drive ?
                </p>
            </div>

            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Heroicon name: outline/globe-alt -->
                                <img src="{{ asset('icons/drive.svg') }}" alt="Drive" class="h-6 w-6" style="filter: invert(1);">
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Retrait rapide au Drive</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Récupérez vos courses sans sortir de votre voiture. Nous chargeons votre coffre en 5 minutes.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <img src="{{ asset('icons/secure.svg') }}" alt="Secure" class="h-6 w-6" style="filter: invert(1);">
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Paiement sécurisé</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Vos données bancaires sont protégées. Payez en ligne ou lors du retrait.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <img src="{{ asset('icons/fresh.svg') }}" alt="Fresh" class="h-6 w-6" style="filter: invert(1);">
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

    <!-- Popular Products Section (Static for now, matching old welcome) -->
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900">Produits populaires</h2>
            </div>

            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @for($i = 1; $i <= 4; $i++)
                <div class="group relative bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-t-lg overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                        <div class="w-full h-full flex items-center justify-center text-gray-400 font-bold text-xl">
                            Produit {{ $i }}
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm text-gray-700">
                            <a href="#">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                Produit exemple {{ $i }}
                            </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">Description du produit</p>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ number_format(rand(200, 999) / 100, 2, ',', ' ') }} €</p>
                    </div>
                </div>
                @endfor
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('produits.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                    Voir tous les produits
                </a>
            </div>
        </div>
    </div>
@endsection
