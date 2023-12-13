<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Je wachtwoord vergeten? Geen probleem. Laat ons gewoon weten je e-mailadres en we sturen je een e-mail met een link waarmee je een nieuw wachtwoord kunt kiezen.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <x-input-error :messages="$errors->get('email')" class="my-2" />

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Email wachtwoord reset link
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
