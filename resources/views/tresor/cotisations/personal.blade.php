@extends('layouts.app-shell-tresor')

@section('title', 'Mes cotisations')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Mes cotisations</h1>

    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Montant</th>
                <th class="border px-4 py-2">Mois</th>
                <th class="border px-4 py-2">Référence</th>
                <th class="border px-4 py-2">Statut</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Facture</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cotisations as $cot)
                <tr>
                    <td class="border px-4 py-2">{{ $cot->id }}</td>
                    <td class="border px-4 py-2">{{ number_format($cot->amount, 2, ',', ' ') }} FCFA</td>
                    <td class="border px-4 py-2">{{ $cot->months }}</td>
                    <td class="border px-4 py-2">{{ $cot->payment_reference }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($cot->status) }}</td>
                    <td class="border px-4 py-2">{{ $cot->created_at->format('d/m/Y') }}</td>
                    <td class="border px-4 py-2">
                        @if($cot->invoice_path && file_exists(public_path("storage/{$cot->invoice_path}")))
                            <a href="{{ asset('storage/' . $cot->invoice_path) }}" target="_blank" class=" px-2 py-1 rounded " style="color: white; background-color: green; text-decoration: none;">
                                Télécharger
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">Aucune cotisation trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $cotisations->links() }}
    </div>
</div>
@endsection
