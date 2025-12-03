@extends('layouts.app')

@section('title', 'Mes Commandes - Drive')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Mes Commandes</h1>
        <p class="page-subtitle">Retrouvez l'historique de vos achats</p>
    </div>
</div>

<section class="content-section">
    <div class="container">
        @if($commandes->isEmpty())
            <div class="empty-state">
                <p>Vous n'avez pas encore passé de commande.</p>
                <a href="{{ route('produits.index') }}" class="btn-primary">Commencer mes achats</a>
            </div>
        @else
            <div class="orders-list">
                @foreach($commandes as $commande)
                    <div class="order-card" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px;">
                        <div class="order-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                            <div class="order-info">
                                <h3 style="margin: 0; color: #2c3e50;">{{ $commande->numero_commande }}</h3>
                                <span class="order-date" style="color: #7f8c8d; font-size: 0.9em;">Passée le {{ $commande->created_at->format('d/m/Y à H:i') }}</span>
                            </div>
                            <div class="order-status">
                                @php
                                    $statusColors = [
                                        'A_PREPARER' => '#f39c12', // Orange
                                        'EN_COURS' => '#3498db', // Bleu
                                        'PRET' => '#2ecc71', // Vert
                                        'TERMINE' => '#27ae60', // Vert foncé
                                        'RUPTURE_PARTIELLE' => '#e74c3c', // Rouge
                                    ];
                                    $color = $statusColors[$commande->statut] ?? '#95a5a6';
                                    $labels = [
                                        'A_PREPARER' => 'À préparer',
                                        'EN_COURS' => 'En cours de préparation',
                                        'PRET' => 'Prête à retirer',
                                        'TERMINE' => 'Terminée',
                                        'RUPTURE_PARTIELLE' => 'Rupture partielle',
                                    ];
                                @endphp
                                <span style="background-color: {{ $color }}; color: white; padding: 5px 10px; border-radius: 15px; font-size: 0.85em;">
                                    {{ $labels[$commande->statut] ?? $commande->statut }}
                                </span>
                            </div>
                        </div>
                        <div class="order-body" style="margin-bottom: 15px;">
                            <p style="margin: 5px 0;"><strong>Créneau de retrait :</strong> {{ $commande->creneau_retrait->format('d/m/Y à H:i') }}</p>
                            <p style="margin: 5px 0;"><strong>Montant total :</strong> {{ number_format($commande->total_ttc, 2, ',', ' ') }} €</p>
                            <p style="margin: 5px 0;"><strong>Articles :</strong> {{ $commande->lignes->count() }}</p>
                        </div>
                        <div class="order-footer" style="text-align: right;">
                            {{-- <a href="{{ route('commande.confirmation', $commande->id) }}" class="btn-secondary">Voir le détail</a> --}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $commandes->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
