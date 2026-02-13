@extends('layouts.app-shell')

@section('title', 'Mes notifications')

@section('content')
<div class="container-fluid py-4">

    <h4 class="fw-bold mb-4">🔔 Notifications</h4>

    <div class="card shadow-sm border-0">
        <div class="list-group list-group-flush">

            @forelse($notifications as $notif)
                <a href=""
                   class="list-group-item list-group-item-action
                   {{ $notif->is_read ? '' : 'fw-bold' }}">

                    <div class="d-flex justify-content-between">
                        <div>
                            <div>{{ $notif->title }}</div>
                            <small class="text-muted">{{ $notif->message }}</small>
                        </div>

                        <small class="text-muted">
                            {{ $notif->created_at->diffForHumans() }}
                        </small>
                    </div>
                </a>
            @empty
                <div class="p-4 text-center text-muted">
                    Aucune notification
                </div>
            @endforelse

        </div>
    </div>

    <div class="mt-3">
        {{ $notifications->links() }}
    </div>

</div>
@endsection

