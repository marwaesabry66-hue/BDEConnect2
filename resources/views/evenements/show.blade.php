@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ $evenement->titre }}</h1>
    <p class="text-gray-600 mb-4">{{ $evenement->description }}</p>
    <p>📍 {{ $evenement->lieu }}</p>
    <p>📅 {{ $evenement->date_debut->format('d/m/Y H:i') }}</p>
    <p>💰 {{ $evenement->prix == 0 ? 'Gratuit' : $evenement->prix.' MAD' }}</p>
    <a href="{{ route('evenements.index') }}" class="mt-4 inline-block bg-gray-200 px-4 py-2 rounded">Retour</a>
</div>
@endsection