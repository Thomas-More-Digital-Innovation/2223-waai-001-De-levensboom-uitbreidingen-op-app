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

                <x-contactgegevens :contactgegevens="$user" />
                <x-form-button text="Wijzigen" />
            </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>