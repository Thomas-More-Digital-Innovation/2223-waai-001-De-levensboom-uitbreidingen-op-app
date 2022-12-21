<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
  @vite('resources/css/app.css')
</head>

<body class="flex row">
  <x-navbar />
  <main class="w-full">
    <div class="min-h-[56px] bg-[#3c8dbc] flex justify-between items-center px-4 text-white">
      <p>Icon</p>
      <p>Naam</p>
    </div>
    <div class="flex row items-end">
      <h1 class="text-2xl mx-2">Dashboard</h1>
      <p class="font-[300]">Welcome to Admin Dashboard</p>
    </div>

    <div class="flex flex-row flex-wrap">

      <a class="flex flex-row rounded-sm m-5 bg-white border shadow-md md:w-[260px] h-[90px]">
        <div class="bg-[#00a65a] object-cover min-w-[80px] md:h-auto"> Font Awesome? </div>
        <div class="flex flex-col mx-2">
          <h3 class="">CLIENTEN</h3>
          <p>Amount</p>
        </div>
      </a>

      <a class="flex flex-row rounded-sm m-5 bg-white border shadow-md md:w-[260px] h-[90px]">
        <div class="bg-[#ff851b] object-cover min-w-[80px] md:h-auto"> Font Awesome? </div>
        <div class="flex flex-col mx-2">
          <h3 class="">BEGELEIDERS</h3>
          <p>Amount</p>
        </div>
      </a>

      <a class="flex flex-row rounded-sm m-5 bg-white border shadow-md md:w-[260px] h-[90px]">
        <div class="bg-[#0073b7] object-cover min-w-[80px] md:h-auto"> Font Awesome? </div>
        <div class="flex flex-col mx-2">
          <h3 class="">AFDELINGEN</h3>
          <p>Amount</p>
        </div>
      </a>

      <a class="flex flex-row rounded-sm m-5 bg-white border shadow-md md:w-[260px] h-[90px]">
        <div class="bg-[#dd4b39] object-cover min-w-[80px] md:h-auto"> Font Awesome? </div>
        <div class="flex flex-col mx-2">
          <h3 class="">NIEUWTJES</h3>
          <p>Amount</p>
        </div>
      </a>

    </div>

  </main>
</body>

</html>