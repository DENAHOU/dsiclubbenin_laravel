<section class="rounded-2xl border border-red-200 bg-transparent p-6">

    <header class="mb-4">
        <h2 class="text-xl font-semibold text-red-700 flex items-center gap-2">
            ⚠️ Suppression du compte
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Cette action est irréversible. Toutes vos données seront définitivement supprimées.
        </p>
    </header>

    <button
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn btn-warning px-4">
        Supprimer mon compte
    </button>

    {{-- MODAL --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-800">
                Confirmer la suppression
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                Veuillez entrer votre mot de passe pour confirmer.
            </p>

            <div class="mt-5">
                <input type="password"
                       name="password"
                       placeholder="Mot de passe"
                       class="w-full rounded-xl border-gray-300 bg-gray-50 focus:border-red-500 focus:ring-red-500">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100">
                    Annuler
                </button>

                <button class="px-5 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700">
                    Supprimer définitivement
                </button>
            </div>
        </form>
    </x-modal>

</section>
