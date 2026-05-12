@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-6">📅 Calendrier des événements</h1>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($evenements as $evenement)
    <div class="bg-white rounded shadow p-5">
        <h2 class="text-lg font-bold mb-2">{{ $evenement->titre }}</h2>
        <p class="text-gray-600 text-sm mb-3">{{ $evenement->description }}</p>
        <div class="text-sm text-gray-500 mb-1">📍 {{ $evenement->lieu }}</div>
        <div class="text-sm text-gray-500 mb-1">📅 {{ $evenement->date_debut->format('d/m/Y H:i') }}</div>
        <div class="text-sm text-gray-500 mb-3">💰 {{ $evenement->prix == 0 ? 'Gratuit' : $evenement->prix.' MAD' }}</div>
        @php $placesRestantes = $evenement->capacite_max - $evenement->inscriptionsConfirmees()->count(); @endphp
        <div class="text-sm mb-4">
            @if($placesRestantes > 0)
                <span class="text-green-600 font-medium">✅ {{ $placesRestantes }} place(s) disponible(s)</span>
            @else
                <span class="text-orange-500 font-medium">⏳ Liste d'attente</span>
            @endif
        </div>
        @auth
            <form method="POST" action="{{ route('inscriptions.store') }}">
                @csrf
                <input type="hidden" name="evenement_id" value="{{ $evenement->id }}">
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">S'inscrire</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block text-center bg-gray-200 text-gray-800 py-2 rounded">Connectez-vous</a>
        @endauth
    </div>
    @empty
    <div class="col-span-3 text-center text-gray-500 py-10">Aucun événement à venir.</div>
    @endforelse
</div>
@endsection