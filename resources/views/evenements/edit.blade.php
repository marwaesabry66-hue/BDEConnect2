@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Modifier l'événement</h1>
    <form method="POST" action="{{ route('evenements.update', $evenement) }}">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Titre</label>
            <input type="text" name="titre" value="{{ old('titre', $evenement->titre) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description', $evenement->description) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Date début</label>
                <input type="datetime-local" name="date_debut" value="{{ old('date_debut', $evenement->date_debut->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Date fin</label>
                <input type="datetime-local" name="date_fin" value="{{ old('date_fin', $evenement->date_fin->format('Y-m-d\TH:i')) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Lieu</label>
            <input type="text" name="lieu" value="{{ old('lieu', $evenement->lieu) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium mb-1">Capacité max</label>
                <input type="number" name="capacite_max" value="{{ old('capacite_max', $evenement->capacite_max) }}" class="w-full border rounded px-3 py-2" min="1">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Prix (MAD)</label>
                <input type="number" name="prix" value="{{ old('prix', $evenement->prix) }}" class="w-full border rounded px-3 py-2" min="0" step="0.01">
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Modifier</button>
            <a href="{{ route('evenements.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded">Annuler</a>
        </div>
    </form>
</div>
@endsection