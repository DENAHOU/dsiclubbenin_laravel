@extends('layouts.app-shell-tresor')

@section('title', 'Rapport Recettes')

@section('content')

<div class="container py-4">

    <h4 class="fw-bold mb-4">📈 Rapport des Recettes Mensuelles</h4>

    <div class="card shadow-sm border-0">

        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">

                <thead class="table-light">
                    <tr>
                        <th>Mois</th>
                        <th>Année</th>
                        <th>Total Collecté</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($monthlyRevenue as $row)
                        <tr>
                            <td>{{ \Carbon\Carbon::create()->month($row->month)->format('F') }}</td>
                            <td>{{ $row->year }}</td>
                            <td class="fw-bold text-success">
                                {{ number_format($row->total, 0, ',', ' ') }} FCFA
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-3">
                                Aucune donnée disponible
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection
