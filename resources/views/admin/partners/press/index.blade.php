@extends('layouts.app-shell-superadmin')

@section('content')
<h3>📰 Partenaires Presse</h3>

<a href="{{ route('admin.partners.press.create') }}" class="btn btn-success mb-3">
    Ajouter
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Logo</th>
            <th>Nom</th>
            <th>Site</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pressPartners as $p)
        <tr>
            <td>
                @if($p->logo)
                    <img src="{{ asset('storage/'.$p->logo) }}" height="40">
                @endif
            </td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->website }}</td>
            <td>{{ $p->description }}</td>
            <td>
                <a href="{{ route('admin.partners.press.edit', $p->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('admin.partners.press.delete', $p->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
