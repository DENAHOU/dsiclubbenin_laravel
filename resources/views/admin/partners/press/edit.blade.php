@extends('layouts.app-shell-superadmin')

@section('content')
<h3>Modifier Partenaire Presse</h3>

<form method="POST" enctype="multipart/form-data"
      action="{{ route('admin.partners.press.update', $partner->id) }}">
@csrf @method('PUT')

<input class="form-control mb-2" name="name" value="{{ $partner->name }}" required>
<input class="form-control mb-2" name="website" value="{{ $partner->website }}">

@if($partner->logo)
<img src="{{ asset('storage/'.$partner->logo) }}" height="60">
@endif

<input type="file" class="form-control mb-2" name="logo">

<input type="textarea" class="form-control mb-2" name="description" value="{{ $partner->description }}" placeholder="Description">

<button class="btn btn-primary">Mettre à jour</button>
</form>
@endsection
