@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Créer un événement</h1>
    <form method="POST" action="{{ route('evenements.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Titre</label>
            <input type="text" name="titre" value="{{ old('titre') }}" class="w-full border rounded px-3 py-2">
            @error('titre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Date début</label>
                <input type="datetime-local" name="date_debut" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Date fin</label>
                <input type="datetime-local" name="date_fin" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Lieu</label>
            <input type="text" name="lieu" class="w-full border rounded px-3 py-2">
        </div>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium mb-1">Capacité max</label>
                <input type="number" name="capacite_max" class="w-full border rounded px-3 py-2" min="1">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Prix (MAD)</label>
                <input type="number" name="prix" value="0" class="w-full border rounded px-3 py-2" min="0" step="0.01">
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Créer</button>
            <a href="{{ route('evenements.index') }}" class="bg-gray-200 text-gray-800 px-6 py-2 rounded">Annuler</a>
        </div>
    </form>
</div>
@endsection