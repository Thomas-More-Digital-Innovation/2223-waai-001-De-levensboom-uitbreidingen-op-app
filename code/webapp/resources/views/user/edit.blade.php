<!doctype html>
<html>

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

                <x-errormessage />
    
                <x-form-input name="firstname" text="Voornaam" :value="$user" />
                <x-form-input name="surname" text="Achternaam" :value="$user" />
                <x-form-input name="email" text="E-mail" :value="$user" disabled="disabled" />
                <form method="POST" action="{{ route('password.update') }}">
                  @method('PATCH')
                  @csrf
                  <!-- Current Password -->
                  <div class="mt-4">
                      <x-input-label for="current_password" :value="__('current_password')" />
                      <x-text-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required />
                      <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                  </div>
          
                  <!-- Password -->
                  <div class="mt-4">
                      <x-input-label for="password" :value="__('Password')" />
                      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
          
                  <!-- Confirm Password -->
                  <div class="mt-4">
                      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
          
                      <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                          type="password"
                                          name="password_confirmation" required autocomplete="new-password" />
          
                      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                  </div>
          
                  <div class="flex items-center justify-end mt-4">
                      <x-primary-button>
                          {{ __('Reset Password') }}
                      </x-primary-button>
                  </div>
              </form>
                <x-contactgegevens :contactgegevens="$user" />

                <div class="flex gap-5">
                  <x-form-button text="Wijzigen" />
                  <x-form-button text="Annuleren" link="user.index" />
                </div>
            </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>