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

      <div class="flex flex-row">
        <div class="m-5 bg-white rounded border flex w-full flex-col h-full">
          <div class="border-t-4 rounded border-[#3c8dbc]">
            <div class="m-3">
                <h1 class="text-2xl">Info segment toevoegen</h1>
                <form action="{{ route('adults.store') }}" method="POST" class="flex flex-col mt-3">
                    @csrf
                    @method('POST')
        
                    <label for="title" class="font-bold">Titel*</label>
                    <input type="text" name="title" id="title" placeholder="Enter titel" required class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
        
                    <button type="submit" class="bg-[#3c8dbc] rounded mr-auto px-4 py-1 mt-5 text-white">Toevoegen</button>
                </form>
            </div>
          </div>
        </div>
        <div class="m-5 bg-white rounded border flex w-full flex-col h-full">
          <div class="border-t-4 rounded border-[#3c8dbc]">
            <div class="m-3">
                <h1 class="text-2xl">Infoblokken</h1>
                <p class="mt-3 text-gray-800">Voeg de info blokken toe op de update pagina</p>
            </div>
          </div>
        </div>
      </div>
  </main>
</body>

</html>