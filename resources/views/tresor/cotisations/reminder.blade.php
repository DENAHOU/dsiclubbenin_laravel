@extends('layouts.app-shell-tresor')

@section('title', 'Relance cotisations')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Membres à relancer</h1>

    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Membre</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Téléphone</th>
                <th class="border px-4 py-2">Mois de retard</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($unpaidMembers as $member)
                <tr>
                    <td class="border px-4 py-2">{{ $member->name }}</td>
                    <td class="border px-4 py-2">{{ $member->email }}</td>
                    <td class="border px-4 py-2">{{ $member->phone ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $member->months_late }}</td>
                    <td class="border px-4 py-2">
                        <button class=" px-3 py-1 rounded send-reminder-btn" data-id="{{ $member->id }}" style="color: white; background-color: rgba(255, 255, 0, 0.801);">
                            Envoyer relance
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center">Aucun membre à relancer</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
document.querySelectorAll('.send-reminder-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const memberId = this.dataset.id;
        if(confirm("Voulez-vous vraiment envoyer la relance ?")) {
            fetch("{{ route('tresor.cotisations.sendReminder') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                body: JSON.stringify({ member_id: memberId })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    alert(data.message);
                }
            });
        }
    });
});
</script>
@endsection
