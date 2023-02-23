<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Nieuwtjes</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
            <h1 class="text-2xl">Nieuwtje toevoegen</h1>
            <form action="{{ route('news.store') }}" method="POST" class="flex flex-col mt-3">
              @csrf
              @method('POST')
  
              <x-form-input name="title" text="Titel" />
              <x-form-input name="shorttext" text="Korte inhoud" />

              <label for="text" class="font-bold">Inhoud</label>
              <input type="text" name="text" id="text" placeholder="Enter inhoud" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
  
              <x-form-button text="Aanmaken" />
            </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>