@extends('layouts.app-shell')

@section('title', 'Notifications')

@section('content')
<div class="container py-4">

<h4 class="fw-bold mb-4">🔔 Notifications</h4>

<div class="card shadow-sm border-0">
    <div class="list-group list-group-flush">

        @forelse($notifications as $n)
            <a href=""
               class="list-group-item list-group-item-action {{ !$n->is_read ? 'bg-light' : '' }}">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>{{ $n->title }}</strong>
                        <p class="mb-1">{{ $n->message }}</p>
                        <small class="text-muted">
                            {{ $n->created_at->diffForHumans() }}
                        </small>
                    </div>

                    @if(!$n->is_read)
                        <span class="badge bg-success">Nouveau</span>
                    @endif
                </div>
            </a>
        @empty
            <div class="text-center p-4 text-muted">
                Aucune notification.
            </div>
        @endforelse

    </div>
</div>

</div>
@endsection
