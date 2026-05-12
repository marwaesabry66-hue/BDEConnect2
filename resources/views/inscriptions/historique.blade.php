@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-6">📋 Mes inscriptions</h1>
<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full table-auto">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Événement</th>
                <th class="px-4 py-3 text-left">Date inscription</th>
                <th class="px-4 py-3 text-left">Statut</th>
                <th class="px-4 py-3 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inscriptions as $inscription)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3">{{ $inscription->evenement->titre }}</td>
                <td class="px-4 py-3">{{ $inscription->date_inscription->format('d/m/Y H:i') }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-sm {{ $inscription->statut === 'confirmée' ? 'bg-green-100 text-green-800' : ($inscription->statut === 'liste_attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $inscription->statut }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    @if($inscription->statut !== 'annulée')
                    <form method="POST" action="{{ route('inscriptions.cancel', $inscription->id) }}" onsubmit="return confirm('Annuler?')">
                        @csrf @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded text-sm">Annuler</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">Aucune inscription.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection