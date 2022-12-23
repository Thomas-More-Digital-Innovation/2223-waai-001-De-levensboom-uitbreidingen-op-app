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
          <div class="flex items-center justify-between">
            <h1 class="text-2xl">Afdelingen lijst</h1>
            <a href=""><iconify-icon icon="fa6-solid:plus" class="text-3xl text-[#3c8dbc]"></iconify-icon></a>
          </div>
          <div class="mt-5 grid grid-cols-3">
            <p>Naam</p>
            <p>Contactgegevens</p>
            <p>Acties</p>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>