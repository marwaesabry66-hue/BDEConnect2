@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-6">📊 Dashboard Admin</h1>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-blue-600 text-white p-5 rounded shadow text-center">
        <div class="text-3xl font-bold">{{ $totalEvenements }}</div>
        <div class="text-sm mt-1">Événements</div>
    </div>
    <div class="bg-green-600 text-white p-5 rounded shadow text-center">
        <div class="text-3xl font-bold">{{ $confirmes }}</div>
        <div class="text-sm mt-1">Confirmés</div>
    </div>
    <div class="bg-yellow-500 text-white p-5 rounded shadow text-center">
        <div class="text-3xl font-bold">{{ $listeAttente }}</div>
        <div class="text-sm mt-1">Liste d'attente</div>
    </div>
    <div class="bg-red-500 text-white p-5 rounded shadow text-center">
        <div class="text-3xl font-bold">{{ $annules }}</div>
        <div class="text-sm mt-1">Annulés</div>
    </div>
</div>
<div class="bg-white rounded shadow p-6">
    <h2 class="text-lg font-bold mb-4">🏆 Top 3 événements</h2>
    <table class="w-full table-auto">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left">Événement</th>
                <th class="px-4 py-3 text-left">Inscrits</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topEvenements as $ev)
            <tr class="border-t">
                <td class="px-4 py-3">{{ $ev->titre }}</td>
                <td class="px-4 py-3">{{ $ev->nb_confirmes }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection