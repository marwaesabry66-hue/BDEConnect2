@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Gestion des Événements</h1>
    <a href="{{ route('evenements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nouvel événement</a>
</div>
<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full table-auto">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Titre</th>
                <th class="px-4 py-3 text-left">Date début</th>
                <th class="px-4 py-3 text-left">Lieu</th>
                <th class="px-4 py-3 text-left">Capacité</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($evenements as $evenement)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3">{{ $evenement->titre }}</td>
                <td class="px-4 py-3">{{ $evenement->date_debut->format('d/m/Y H:i') }}</td>
                <td class="px-4 py-3">{{ $evenement->lieu }}</td>
                <td class="px-4 py-3">{{ $evenement->inscriptionsConfirmees()->count() }} / {{ $evenement->capacite_max }}</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('evenements.edit', $evenement) }}" class="bg-yellow-400 text-white px-3 py-1 rounded text-sm">Modifier</a>
                    <form method="POST" action="{{ route('evenements.destroy', $evenement) }}" onsubmit="return confirm('Supprimer?')">
                        @csrf @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded text-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">Aucun événement.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection