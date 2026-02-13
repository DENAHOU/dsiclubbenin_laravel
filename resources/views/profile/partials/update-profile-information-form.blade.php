<section class="bg-white rounded-2xl shadow-sm border p-6">

    {{-- HEADER --}}
    <header class="mb-6 border-b pb-4">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            👤 {{ __('Informations du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __("Mettez à jour vos informations personnelles et votre adresse e-mail.") }}
        </p>
    </header>

    {{-- EMAIL VERIFICATION --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- FORM --}}
    <form method="post"
          action="{{ route('profile.update') }}"
          class="space-y-6">
        @csrf
        @method('patch')

        {{-- NOM --}}
        <div>
            <x-input-label for="name" value="Nom complet" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-2 block w-full rounded-lg"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- EMAIL --}}
        <div>
            <x-input-label for="email" value="Adresse e-mail" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-2 block w-full rounded-lg"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            {{-- VERIFICATION --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                    <p class="text-sm text-yellow-800">
                        ⚠️ {{ __('Votre adresse e-mail n’est pas vérifiée.') }}
                        <button
                            form="send-verification"
                            class="underline font-medium hover:text-yellow-900">
                            {{ __('Renvoyer le lien de vérification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            ✅ {{ __('Un nouveau lien de vérification a été envoyé.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- ACTIONS --}}
        <div class="flex items-center gap-4">
            <x-primary-button class="px-6 py-2 rounded-lg">
                💾 {{ __('Enregistrer') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-green-600"
                >
                    ✔️ {{ __('Modifications enregistrées') }}
                </p>
            @endif
        </div>
    </form>

</section>
