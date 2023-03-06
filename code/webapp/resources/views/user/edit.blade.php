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
                <section>
                  <header>
                      <h2 class="text-lg font-medium text-gray-900">
                          {{ __('Update Password') }}
                      </h2>
              
                      <p class="mt-1 text-sm text-gray-600">
                          {{ __('Ensure your account is using a long, random password to stay secure.') }}
                      </p>
                  </header>
              
                  <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                      @csrf
                      @method('put')
              
                      <div>
                          <x-input-label for="current_password" :value="__('Current Password')" />
                          <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                          <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                      </div>
              
                      <div>
                          <x-input-label for="password" :value="__('New Password')" />
                          <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                          <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                      </div>
              
                      <div>
                          <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                          <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                          <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                      </div>
              
                      <div class="flex items-center gap-4">
                          <x-primary-button>{{ __('Save') }}</x-primary-button>
              
                          @if (session('status') === 'password-updated')
                              <p
                                  x-data="{ show: true }"
                                  x-show="show"
                                  x-transition
                                  x-init="setTimeout(() => show = false, 2000)"
                                  class="text-sm text-gray-600"
                              >{{ __('Saved.') }}</p>
                          @endif
                      </div>
                  </form>
                </section>
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