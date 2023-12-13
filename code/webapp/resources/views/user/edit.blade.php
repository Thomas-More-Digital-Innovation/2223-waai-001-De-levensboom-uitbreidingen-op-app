@extends('layout')
<title>Waaiburg - Account</title>
@section('content')
    <h1 class="text-2xl">Account wijzigen</h1>

    <p class="text-xl mt-10">Tweefactorauthenticatie</p>
    {{-- Enable two factor --}}
    @if (session('status') == 'two-factor-authentication-enabled')
        <div class="mb-4 font-medium text-sm">
            Voltooi de tweefactorauthenticatie configuratie hieronder.
        </div>
    @endif

    @if (session('status') == 'two-factor-authentication-confirmed')
        <div class="mb-4 font-medium text-sm">
            Tweefactorauthenticatie succesvol bevestigd en ingeschakeld.
        </div>
    @endif
    @if (!auth()->user()->two_factor_secret)
        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
            @csrf
            @method('post')

            <button type="submit" class="bg-wb-blue rounded px-4 py-1 mt-5 text-white">
                Aanzetten
            </button>
        </form>
    @else
        <div class="mt-5">
            <form method="POST" action="user/two-factor-authentication">
                @csrf
                @method('delete')

                <button type="submit" class="bg-wb-blue rounded px-4 py-1 mt-5 text-white">
                    Uitzetten
                </button>
            </form>
        </div>
    @endif

    @if (auth()->user()->two_factor_secret)
        <p class="mb-3">QR Code voor uw authenticatie app:</p>
        {!! auth()->user()->twoFactorQrCodeSvg() !!}

        {{-- Recovery --}}
        <p class="text-xl mt-10">Herstel codes: </p>
        @foreach (Auth::user()->recoveryCodes() as $code)
            {{ $code }} <br>
        @endforeach
    @endif



    <form action="{{ route('user.update', $user->id) }}" method="POST" class="flex flex-col mt-10">
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
@endsection
