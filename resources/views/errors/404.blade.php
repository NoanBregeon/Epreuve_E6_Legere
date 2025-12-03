@extends('layouts.app')

@section('title', 'Page non trouvée')

@section('content')
<div class="container" style="text-align: center; padding: 5rem 0;">
    <h1 style="font-size: 4rem; margin-bottom: 1rem;">404</h1>
    <p style="font-size: 1.5rem; margin-bottom: 2rem;">Oups ! La page que vous cherchez n'existe pas.</p>
    <a href="{{ route('accueil') }}" class="btn-primary">Retour à l'accueil</a>
</div>
@endsection
