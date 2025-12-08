@extends('layouts.app')

@section('title', 'Finaliser ma commande - Drive')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Finaliser votre commande
            </h1>
            <p class="mt-4 text-lg text-gray-500">
                Plus qu'une étape avant de récupérer vos courses !
            </p>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <!-- Formulaire (Gauche) -->
            <div class="lg:col-span-7">
                <form action="{{ route('commande.store') }}" method="POST" id="checkout-form">
                    @csrf

                    <!-- Section 1: Créneau -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:px-6 bg-indigo-600">
                            <h3 class="text-lg leading-6 font-medium text-white">
                                1. Créneau de retrait
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-indigo-100">
                                Choisissez quand vous souhaitez passer récupérer vos courses.
                            </p>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <label for="creneau_retrait" class="block text-sm font-medium text-gray-700">Date et heure de retrait</label>
                                    <select id="creneau_retrait" name="creneau_retrait" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md border">
                                        <option value="">-- Choisir un créneau --</option>
                                        @foreach($creneaux as $creneau)
                                            <option value="{{ $creneau['value'] }}">{{ $creneau['label'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('creneau_retrait')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="note_interne" class="block text-sm font-medium text-gray-700">Note pour le préparateur (optionnel)</label>
                                    <div class="mt-1">
                                        <textarea id="note_interne" name="note_interne" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Ex: Merci de choisir des avocats bien mûrs..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Paiement -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:px-6 bg-indigo-600">
                            <h3 class="text-lg leading-6 font-medium text-white">
                                2. Paiement
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-indigo-100">
                                Choisissez votre méthode de paiement préférée.
                            </p>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <fieldset>
                                <legend class="sr-only">Moyen de paiement</legend>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="paiement_sur_place" name="moyen_paiement" type="radio" value="SUR_PLACE" checked onchange="togglePaymentForm()" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="paiement_sur_place" class="ml-3 block text-sm font-medium text-gray-700">
                                            Paiement au retrait (Carte ou Espèces)
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="paiement_carte" name="moyen_paiement" type="radio" value="CB" onchange="togglePaymentForm()" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="paiement_carte" class="ml-3 block text-sm font-medium text-gray-700">
                                            Paiement en ligne (Carte Bancaire)
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <div id="card-form" class="mt-6 bg-gray-50 rounded-md p-4 border border-gray-200 hidden">
                                <h4 class="text-sm font-medium text-gray-900 mb-4">Informations de carte bancaire</h4>
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <label for="card_number" class="block text-sm font-medium text-gray-700">Numéro de carte</label>
                                        <input type="text" id="card_number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border p-2" placeholder="0000 0000 0000 0000">
                                    </div>

                                    <div class="col-span-3">
                                        <label for="card_expiry" class="block text-sm font-medium text-gray-700">Expiration</label>
                                        <input type="text" id="card_expiry" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border p-2" placeholder="MM/AA">
                                    </div>

                                    <div class="col-span-3">
                                        <label for="card_cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                                        <input type="text" id="card_cvc" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md border p-2" placeholder="123">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-md bg-blue-50 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <!-- Heroicon name: solid/information-circle -->
                                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 flex-1 md:flex md:justify-between">
                                <p class="text-sm text-blue-700">
                                    En validant votre commande, vous vous engagez à venir la retirer au créneau choisi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out text-lg">
                        Confirmer et payer {{ number_format($totalTTC, 2, ',', ' ') }} €
                    </button>
                </form>
            </div>

            <!-- Récapitulatif (Droite) -->
            <div class="lg:col-span-5 mt-8 lg:mt-0">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg sticky top-6">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Récapitulatif de la commande
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <ul class="divide-y divide-gray-200">
                            @foreach($panier as $id => $item)
                            <li class="py-4 flex">
                                <div class="flex-shrink-0 h-16 w-16 border border-gray-200 rounded-md overflow-hidden">
                                    @if(isset($item['image']) && $item['image'])
                                        <img src="{{ Str::startsWith($item['image'], 'data:') ? $item['image'] : asset('storage/' . $item['image']) }}" alt="{{ $item['libelle'] }}" class="h-full w-full object-cover object-center">
                                    @else
                                        <div class="h-full w-full bg-gray-100 flex items-center justify-center text-gray-400 font-bold">
                                            {{ substr($item['libelle'], 0, 2) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1 flex flex-col">
                                    <div>
                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                            <h3>{{ $item['libelle'] }}</h3>
                                            @if(isset($remises['details'][$id]))
                                                <div class="text-right">
                                                    <p class="text-xs text-gray-500 line-through">{{ number_format($item['prix_ttc'] * $item['quantite'], 2, ',', ' ') }} €</p>
                                                    <p class="text-red-600">{{ number_format(($item['prix_ttc'] * $item['quantite']) - $remises['details'][$id]['remise'], 2, ',', ' ') }} €</p>
                                                </div>
                                            @else
                                                <p class="ml-4">{{ number_format($item['prix_ttc'] * $item['quantite'], 2, ',', ' ') }} €</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1 flex items-end justify-between text-sm">
                                        <p class="text-gray-500">Qté {{ $item['quantite'] }}</p>
                                        @if(isset($remises['details'][$id]))
                                            <p class="text-xs text-green-600">{{ $remises['details'][$id]['libelle_promo'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex justify-between text-base font-medium text-gray-900 mb-2">
                                <p>Sous-total</p>
                                <p>{{ number_format($totalTTC + ($remises['total_remise'] ?? 0), 2, ',', ' ') }} €</p>
                            </div>
                            @if(isset($remises['total_remise']) && $remises['total_remise'] > 0)
                                <div class="flex justify-between text-base font-medium text-green-600 mb-2">
                                    <p>Remises</p>
                                    <p>-{{ number_format($remises['total_remise'], 2, ',', ' ') }} €</p>
                                </div>
                            @endif
                            <div class="flex justify-between text-sm text-gray-500 mb-4">
                                <p>TVA incluse</p>
                                <p>~ {{ number_format($totalTTC - ($totalTTC / 1.055), 2, ',', ' ') }} €</p>
                            </div>
                            <div class="flex justify-between text-xl font-bold text-indigo-600 border-t border-gray-200 pt-4">
                                <p>Total à payer</p>
                                <p>{{ number_format($totalTTC, 2, ',', ' ') }} €</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePaymentForm() {
        const isCard = document.getElementById('paiement_carte').checked;
        const cardForm = document.getElementById('card-form');

        if (isCard) {
            cardForm.classList.remove('hidden');
        } else {
            cardForm.classList.add('hidden');
        }

        // Rendre les champs requis si paiement CB
        const inputs = cardForm.querySelectorAll('input');
        inputs.forEach(input => {
            input.required = isCard;
        });
    }
</script>
@endsection
