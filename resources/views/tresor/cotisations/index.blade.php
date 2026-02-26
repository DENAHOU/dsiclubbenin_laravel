@extends('layouts.app-shell-tresor')


@section('title', 'Liste des cotisations')

@section('content')
<div class="container mx-auto p-4">

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('tresor.cotisations.create') }}" style="color: white; background-color: #053177; text-decoration: none;" class="px-2 py-1 rounded" class=" px-2 py-2 rounded mb-2">
        Ajouter une cotisation
    </a>

    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-2">ID</th>
                <th class="border px-2 py-2">Membre</th>
                <th class="border px-2 py-2">Montant</th>
                <th class="border px-2 py-2">Mois</th>
                <th class="border px-2 py-2">Référence</th>
                <th class="border px-2 py-2">Statut</th>
                <th class="border px-2 py-2">Date</th>
                <th class="border px-2 py-2">Facture</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cotisations as $cot)
                <tr>
                    <td class="border px-2 py-2">{{ $cot->id }}</td>
                    <td class="border px-2 py-2">{{ $cot->user->name }}</td>
                    <td class="border px-2 py-2">{{ number_format($cot->amount, 2, ',', ' ') }} FCFA</td>
                    <td class="border px-2 py-2">{{ $cot->months }}</td>
                    <td class="border px-2 py-2">{{ $cot->payment_reference }}</td>
                    <td class="border px-2 py-2">{{ ucfirst($cot->status) }}</td>
                    <td class="border px-2 py-2">{{ $cot->created_at->format('d/m/Y') }}</td>
                    <td class="border px-2 py-2">
                        @if($cot->invoice_path && file_exists(public_path("storage/{$cot->invoice_path}")))
                            <a href="{{ asset('storage/' . $cot->invoice_path) }}" target="_blank" style="color: white; background-color: green; text-decoration: none;" class="px-2 py-1 rounded">
                                Télécharger
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="border px-2 py-2 text-center">Aucune cotisation trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
