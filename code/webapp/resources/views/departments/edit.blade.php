<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Afdelingen</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <h1 class="text-2xl">Afdeling wijzigen</h1>
          <form action="{{ route('departments.update', $department->id) }}" method="POST" class="flex flex-col mt-3">
            @csrf
            @method('PATCH')

            <x-errormessage />

            <x-form-input name="name" text="Naam" :value="$department" />

            <x-contactgegevens :contactgegevens="$department" />
            <div class="flex gap-5">
              <x-form-button text="Bewerk" />
              <x-form-button text="Annuleren" link="departments.index" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>