@extends('layouts.app-shell-superadmin')

@section('content')
<h3>Ajouter Partenaire Presse</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.partners.press.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input class="form-control mb-2" name="name" placeholder="Nom" required>

    <input class="form-control mb-2" name="website" placeholder="Site web">

    <input type="file" class="form-control mb-2" name="logo">

    <textarea class="form-control mb-2" name="description" placeholder="Description"></textarea>

    <button class="btn btn-success">Enregistrer</button>
</form>
@endsection
