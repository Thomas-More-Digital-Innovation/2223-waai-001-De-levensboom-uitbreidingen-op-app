<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Waaiburg - Account</title>
</head>

<body class="flex">
    <x-navbar />
    <main class="w-full bg-[#ecf0f5]">
        <x-topbar />
        <x-welcome />

        <div class="m-5 bg-white rounded border">
            <div class="border-t-4 rounded border-[#3c8dbc]">
                <div class="m-3">
                    <h1 class="text-2xl">Account wijzigen</h1>
                    <form action="{{ route('user.update', $user->id) }}" method="POST" class="flex flex-col mt-3">
                        @csrf
                        @method('PATCH')

                        <x-form-input name="firstname" text="Voornaam" :value="$user" />
                        <x-form-input name="surname" text="Achternaam" :value="$user" />
                        <x-form-input name="email" text="E-mail" :value="$user" disabled="disabled" />
                        <x-contactgegevens :contactgegevens="$user" />
                        <div class="flex gap-5">
                            <x-form-button text="Wijzigen" />
                            <x-form-button text="Annuleren" link="user.index" />
                        </div>
                    </form>

                    <h2 id="Pass" class="text-lg font-medium text-gray-900 mt-5">
                        Wachtwoord updaten
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Zorg ervoor dat uw account een lang, willekeurig wachtwoord gebruikt om veilig te blijven.
                    </p>
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <div class="flex flex-col">
                            <x-form-input name="current_password" text="Huidige wachtwoord" type="password" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>
                        <div class="flex flex-col">
                            <x-form-input name="password" text="Nieuw wachtwoord" type="password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>
                        <div class="flex flex-col">
                            <x-form-input name="password_confirmation" text="Herhaal wachtwoord" type="password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>Opslaan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
