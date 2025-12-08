<nav x-data="{ open: false }" class="bg-white shadow-md relative z-50">
    <!-- Top Bar (Services & Account) -->
    <div class="bg-cyan-900 text-white text-xs py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex space-x-4 items-center">
                @auth
                    <span class="text-cyan-200">Bonjour, {{ Auth::user()->name }}</span>
                    <a href="{{ route('commande.index') }}" class="hover:text-white font-bold">Mes Commandes</a>
                    <a href="{{ route('profile.edit') }}" class="hover:text-white font-bold">Mon Compte</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-red-300">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center hover:text-cyan-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="hover:text-cyan-200">Créer un compte</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Header (Logo, Search, Cart) -->
    <div class="bg-white py-4 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('accueil') }}" class="flex items-center gap-2">
                    <div class="bg-cyan-600 text-white p-2 rounded-full">
                        <x-application-logo class="block h-8 w-8 fill-current" />
                    </div>
                    <span class="text-2xl font-black text-cyan-800 tracking-tight">DRIVE<span class="text-red-500">.E6</span></span>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex-1 w-full max-w-2xl mx-4">
                <form action="{{ route('produits.index') }}" method="GET" class="relative">
                    <div class="flex">
                        <input type="text" name="search"
                               class="w-full border-2 border-cyan-600 rounded-l-full py-2 px-4 focus:outline-none focus:ring-0 focus:border-cyan-700 text-gray-700"
                               placeholder="Je cherche un produit, une marque..."
                               value="{{ request('search') }}">
                        <button type="submit" class="bg-cyan-600 text-white px-6 rounded-r-full hover:bg-cyan-700 transition-colors flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Store & Cart -->
            <div class="flex items-center gap-4">
                <!-- Store Selector -->
                <div class="hidden lg:flex flex-col items-end text-sm text-gray-600 border-r border-gray-200 pr-4">
                    <span class="font-bold text-gray-800">Mon Magasin</span>
                    <span class="text-green-600 flex items-center text-xs">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span> Ouvert
                    </span>
                </div>

                <!-- Cart Button -->
                <a href="{{ route('panier.index') }}" class="group relative flex items-center bg-cyan-600 text-white px-4 py-2 rounded-lg hover:bg-cyan-700 transition-all shadow-sm hover:shadow-md">
                    <div class="relative p-1">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        @php
                            $cartCount = array_sum(array_column(session('panier', []), 'quantite'));
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center border-2 border-cyan-600">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </div>
                    <span class="ml-2 font-bold hidden sm:inline">Mon Panier</span>
                    <span class="ml-2 text-cyan-100 text-sm hidden sm:inline border-l border-cyan-500 pl-2">
                        {{ number_format(app(\App\Services\PanierService::class)->getTotalTTC(), 2, ',', ' ') }} €
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Categories Navigation (Bottom Bar) -->
    <div class="bg-cyan-700 text-white shadow-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-8 overflow-x-auto py-3 text-sm font-medium no-scrollbar">
                <a href="{{ route('produits.index') }}" class="flex items-center hover:text-cyan-200 whitespace-nowrap">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    Tous les rayons
                </a>
                <a href="{{ route('produits.index', ['categorie' => 'Fruits & Légumes']) }}" class="hover:text-cyan-200 whitespace-nowrap">Fruits & Légumes</a>
                <a href="{{ route('produits.index', ['categorie' => 'Boucherie']) }}" class="hover:text-cyan-200 whitespace-nowrap">Boucherie</a>
                <a href="{{ route('produits.index', ['categorie' => 'Frais']) }}" class="hover:text-cyan-200 whitespace-nowrap">Produits Frais</a>
                <a href="{{ route('produits.index', ['categorie' => 'Epicerie']) }}" class="hover:text-cyan-200 whitespace-nowrap">Épicerie</a>
                <a href="{{ route('produits.index', ['categorie' => 'Boissons']) }}" class="hover:text-cyan-200 whitespace-nowrap">Boissons</a>
                <a href="{{ route('promotions.index') }}" class="text-red-300 font-bold hover:text-red-100 whitespace-nowrap">Promotions</a>
            </div>
        </div>
    </div>
</nav>
