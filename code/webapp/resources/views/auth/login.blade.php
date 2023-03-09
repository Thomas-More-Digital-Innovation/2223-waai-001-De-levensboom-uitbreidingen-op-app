<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="flex flex-col">
            <x-form-input name="email" text="Email" type="email" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="flex flex-col">
            <x-form-input name="password" text="Wachtwoord" type="password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring-gray-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Onthou mij</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" href="{{ route('password.request') }}">
                    Wachtwoord vergeten?
                </a>
            @endif

            <x-primary-button class="ml-3">
                Inloggen
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
