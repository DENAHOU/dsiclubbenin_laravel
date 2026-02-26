@extends('layouts.app-shell-tresor')

@section('title', 'Créer une cotisation')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Créer une cotisation</h1>

    @if ($errors->any())
        <div class="bg-red-100 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-600">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tresor.cotisations.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="user_id" class="block font-medium">Membre</label>
            <select name="user_id" id="user_id" class="border rounded p-2 w-full">
                <option value="">-- Sélectionner un membre --</option>
                @foreach ($members as $m)
                    <option value="{{ $m->id }}" {{ (isset($member) && $member->id == $m->id) ? 'selected' : '' }}>
                        {{ $m->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="amount" class="block font-medium">Montant</label>
            <input type="number" name="amount" id="amount" class="border rounded p-2 w-full" value="{{ old('amount') }}" min="0" step="0.01">
        </div>

        <div class="mb-4">
            <label for="months" class="block font-medium">Nombre de mois</label>
            <input type="number" name="months" id="months" class="border rounded p-2 w-full" value="{{ old('months') }}" min="1">
        </div>

        <div class="mb-4">
            <label for="created_at" class="block font-medium">Date de cotisation</label>
            <input type="date" name="created_at" id="created_at" class="border rounded p-2 w-full" value="{{ old('created_at', now()->format('Y-m-d')) }}">
        </div>

        <button type="submit" class=" px-4 py-2 rounded" style="color: white; background-color: #06398a; text-decoration: none;">
            Enregistrer
        </button>
    </form>
</div>
@endsection
