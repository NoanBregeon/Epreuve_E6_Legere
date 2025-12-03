@extends('layouts.app')

@section('title', 'Mon compte')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Mon compte</h1>
        <p class="page-subtitle">
            Espace client (maquette) – les données seront reliées à la base plus tard.
        </p>
    </div>
</div>

<section class="content-section">
    <div class="container account-grid">

        <div class="account-card">
            <h2>Informations personnelles</h2>
            <p>
                Ici, le client pourra consulter et modifier ses informations
                (nom, prénom, e-mail, coordonnées, etc.).
            </p>
        </div>

        <div class="account-card">
            <h2>Mes commandes</h2>
            <p>
                Liste des commandes passées sur le Drive, avec le détail des
                articles, montants et statuts.
            </p>
        </div>

        <div class="account-card">
            <h2>Préférences</h2>
            <p>
                Paramètres du compte, préférences de contact, suppression du compte,
                gestion de la confidentialité (conformité RGPD).
            </p>
        </div>

    </div>
</section>
@endsection
