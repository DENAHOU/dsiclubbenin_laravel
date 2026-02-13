<section class="rounded-2xl p-8 bg-transparent">

    {{-- TITRE --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            🔒 Modifier le mot de passe
        </h2>
        <p class="text-gray-500 mt-1">
            Assurez-vous d’utiliser un mot de passe fort et sécurisé.
        </p>
    </div>

    {{-- FORMULAIRE --}}
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        {{-- MOT DE PASSE ACTUEL --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Mot de passe actuel
            </label>
            <input
                type="password"
                name="current_password"
                autocomplete="current-password"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="••••••••"
            >
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- NOUVEAU MOT DE PASSE --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Nouveau mot de passe
            </label>
            <input
                type="password"
                name="password"
                autocomplete="new-password"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="••••••••"
            >
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- CONFIRMATION --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">
                Confirmer le mot de passe
            </label>
            <input
                type="password"
                name="password_confirmation"
                autocomplete="new-password"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="••••••••"
            >
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- ACTIONS --}}
        <div class="flex items-center gap-4 pt-4">
            <button
                type="submit"
                class="btn btn-primary px-4">
                💾 Enregistrer
            </button>

            @if (session('status') === 'password-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-green-600 font-medium"
                >
                    ✔ Mot de passe mis à jour
                </span>
            @endif
        </div>

    </form>
</section>
