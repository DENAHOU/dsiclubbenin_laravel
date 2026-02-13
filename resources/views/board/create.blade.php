@extends('layouts.app-shell-superadmin')

@section('title', 'Ajouter un membre du Bureau')

@section('content')

<h3 class="mb-4">Ajouter un membre du Bureau</h3>

<form method="POST" action="{{ route('admin.board.store') }}">
    @csrf

    <div class="mb-3">
        <label>Rôle :</label>
        <select name="role_id" class="form-select" required>
            @foreach($roles as $r)
                <option value="{{ $r->id }}">{{ $r->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Type de membre :</label>
        <select id="memberType" name="member_type" class="form-select" required>
            <option value="">Sélectionner</option>
            <option value="user">Membre Individuel</option>
            <option value="company">Entité Utilisatrice</option>
            <option value="administration">Administration Publique</option>
            <option value="college">Collège IT</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Membre :</label>
        <select id="memberSelect" name="member_id" class="form-select" required></select>
    </div>

    <div class="mb-3">
        <label>Date de début :</label>
        <input type="date" name="start_date" class="form-control">
    </div>

    <div class="mb-3">
        <label>Date de fin :</label>
        <input type="date" name="end_date" class="form-control">
    </div>


    <button class="btn btn-success">Enregistrer</button>
</form>

<script>
    const data = {
        user: @json($users),
        company: @json($companies),
        administration: @json($administrations),
        college: @json($colleges)
    };

    document.getElementById('memberType').addEventListener('change', function(){
        let type = this.value;
        let members = data[type] ?? [];
        let select = document.getElementById('memberSelect');

        select.innerHTML = "";
        members.forEach(m => {
            select.innerHTML += `<option value="${m.id}">${m.name} (${m.email})</option>`;
        });
    });
</script>

@endsection
