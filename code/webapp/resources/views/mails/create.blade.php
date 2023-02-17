<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Mails</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
            <h1 class="text-2xl">Mail toevoegen</h1>
            <form action="{{ route('news.store') }}" method="POST" class="flex flex-col mt-3">
                @csrf
                @method('POST')
    
                <label for="subject" class="font-bold">Onderwerp*</label>
                <input type="text" name="subject" id="subject" placeholder="Enter onderwerp" required class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                
                <label for="text" class="font-bold">Inhoud*</label>
                <input type="text" name="text" id="text" placeholder="Enter inhoud" required class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
    
                <button type="submit" class="bg-[#3c8dbc] rounded mr-auto px-4 py-1 mt-5 text-white">Toevoegen</button>
            </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>