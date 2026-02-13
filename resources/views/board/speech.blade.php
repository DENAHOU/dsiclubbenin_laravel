@extends('layouts.app-shell-superadmin')

@section('title', 'Discours du membre')

@section('content')

<div class="container-fluid">

    <h3 class="fw-bold mb-4">🗣 Discours officiel</h3>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <img src="{{ $boardMember->memberPhoto() }}"
                     class="rounded-circle mx-auto mb-2"
                     width="100" height="100">

                <h6 class="fw-bold mb-0">{{ $boardMember->memberName() }}</h6>
                <span class="badge bg-primary">{{ $boardMember->role->name }}</span>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm p-4">

                <form method="POST" action="{{ route('admin.board.speech.store', $boardMember->id) }}">
                    @csrf

                    <textarea name="speech" rows="8" class="form-control">
                        {{ old('speech', $boardMember->speech) }}
                    </textarea>

                    <button class="btn btn-primary mt-3">💾 Enregistrer</button>
                </form>


            </div>
        </div>

    </div>

</div>

@endsection
