@extends('layouts.app')

<style>
.admin-shell { display:flex; min-height:100vh; }
.admin-sidebar { width:260px; background:#094281; color:#fff; padding:1.3rem; position:fixed; height:100vh; }
.admin-content { margin-left:260px; padding:2rem; background:#f7fbff; width:calc(100% - 260px); min-height:100vh; }

.detail-card { background:white; padding:1.5rem; border-radius:12px; box-shadow:0 8px 20px rgba(9,66,129,0.06); }
.label { font-weight:600; color:#094281; }
.value { margin-bottom:.8rem; }
.actions { margin-top:1rem; }
.btn-approve,.btn-reject { padding:8px 14px; border-radius:6px; border:none; color:white; }
.btn-approve { background:#2aa84f; }
.btn-reject { background:#e55353; }
</style>

@section('content')

<div class="admin-shell">


    <main class="admin-content">
        <h1 class="h4 mb-4">
            Dossier adhérent — {{ ucfirst($type) }}
        </h1>

        @if($item->status === 'approved')
            <a href="{{ route('admin.board.addForm', ['type' => $type, 'id' => $item->id]) }}"
            class="btn btn-primary mt-3">
                <i class="fa fa-user-plus"></i> Ajouter au bureau
            </a>
        @endif


        <div class="detail-card">

            <h4 class="mb-3">Informations principales</h4>

            {{-- Champs standards --}}
            @foreach($item->getAttributes() as $key => $val)
                @continue(in_array($key, ['password']))
                <div class="value">
                    <span class="label">{{ ucfirst(str_replace('_',' ', $key)) }} :</span>
                    <span>{{ is_null($val) || $val=='' ? '—' : $val }}</span>
                </div>
            @endforeach

            {{-- Section : fichier/logo/photo --}}
            @if(isset($item->photo_path) || isset($item->logo_path))
                <div class="mt-3">
                    <span class="label">Photo / Logo :</span><br>
                    <img src="{{ asset('storage/'.($item->photo_path ?? $item->logo_path)) }}"
                         style="max-height:150px; margin-top:10px; border-radius:8px;">
                </div>
            @endif


            {{-- Actions --}}
            <div class="actions mt-4">
                <a href="{{ route('admin.members') }}" class="btn btn-secondary ms-3">Retour</a>
            </div>

        </div>
    </main>
</div>

@endsection

<script>
document.getElementById('approve-btn').onclick = function() {
    if(!confirm('Approuver cette adhésion ?')) return;

    fetch("{{ route('admin.members.approve', ['type'=>$type, 'id'=>$item->id]) }}", {
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}',
            'Accept':'application/json'
        }
    }).then(r=>r.json())
    .then(data=>{
        alert(data.message || "Approuvé !");
        window.location.href = "{{ route('admin.members') }}";
    });
};

document.getElementById('reject-btn').onclick = function() {
    if(!confirm('Rejeter cette adhésion ?')) return;

    fetch("{{ route('admin.members.reject', ['type'=>$type, 'id'=>$item->id]) }}", {
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}',
            'Accept':'application/json'
        }
    }).then(r=>r.json())
    .then(data=>{
        alert(data.message || "Rejeté !");
        window.location.href = "{{ route('admin.members') }}";
    });
};
</script>
