@extends('layouts.app')

@section('title', 'Commande validée - Drive')

@section('content')
<div class="bg-gray-50 min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Commande validée !
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Votre commande a bien été enregistrée.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="border-b border-gray-200 pb-5 mb-5">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Récapitulatif
                </h3>
            </div>

            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        Numéro de commande
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        #{{ $commande->id }}
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">
                        Date
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $commande->created_at->format('d/m/Y à H:i') }}
                    </dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">
                        Montant total
                    </dt>
                    <dd class="mt-1 text-2xl font-bold text-indigo-600">
                        {{ number_format($commande->total_ttc ?? 0, 2, ',', ' ') }} € TTC
                    </dd>
                </div>
            </dl>

            <div class="mt-8">
                <h4 class="text-sm font-medium text-gray-900">Prochaines étapes</h4>
                <ul class="mt-4 space-y-4">
                    <li class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center h-6 w-6 rounded-full bg-indigo-100 text-indigo-600 text-xs font-bold">1</span>
                        </div>
                        <p class="ml-3 text-sm text-gray-700">Vous recevrez un e-mail de confirmation</p>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center h-6 w-6 rounded-full bg-indigo-100 text-indigo-600 text-xs font-bold">2</span>
                        </div>
                        <p class="ml-3 text-sm text-gray-700">Préparation de votre commande (2-4h)</p>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center h-6 w-6 rounded-full bg-indigo-100 text-indigo-600 text-xs font-bold">3</span>
                        </div>
                        <p class="ml-3 text-sm text-gray-700">Retrait au Drive avec votre code</p>
                    </li>
                </ul>
            </div>

            <div class="mt-8 flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                <a href="{{ route('produits.index') }}" class="flex-1 flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Continuer mes achats
                </a>
                <a href="{{ route('commande.index') }}" class="flex-1 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Mes commandes
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
