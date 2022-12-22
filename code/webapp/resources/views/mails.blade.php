<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full">
    <x-topbar />
    <x-welcome />

    <div class="m-5">
      <h1 class="text-3xl font-bold">
        Mails
      </h1>
    </div>
  </main>
</body>

</html>