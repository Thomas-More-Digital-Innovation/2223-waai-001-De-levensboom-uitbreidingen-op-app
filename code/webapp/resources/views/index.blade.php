<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/test.js')
  <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
</head>

<body class="flex row">
  <x-navbar />
  <main class="w-full">
    <div class="min-h-[56px] bg-[#3c8dbc] flex justify-between items-center px-5 text-white">
      <iconify-icon icon="fa6-solid:bars" class="hover:cursor-pointer"></iconify-icon>
      <p class="hover:cursor-pointer">John Doe</p>
    </div>

    <div class="flex gap-2 items-end ml-5 mt-5">
      <h1 class="text-2xl">Dashboard</h1>
      <p class="font-[300]">Welcome to Admin Dashboard</p>
    </div>

    <div class="grid grid-cols-3 gap-5 m-5">
      <a href="" class="flex rounded-sm border shadow-md">
        <iconify-icon icon="fa6-solid:users" class="bg-[#00a65a] self-center p-6 text-5xl text-white"></iconify-icon>
        <div class="bg-white px-3 py-2 text-[#3c8dbc] font-medium">
          <p>CLIENTEN</p>
          <p class="font-bold text-[#3c8dbc]">AMOUNT</p>
        </div>
      </a>

      <a href="" class="flex rounded-sm border shadow-md">
        <iconify-icon icon="fa6-solid:address-card" class="bg-[#ff851b] self-center px-7 py-6 text-5xl text-white"></iconify-icon>
        <div class="bg-white px-3 py-2 text-[#3c8dbc] font-medium">
          <p>BEGELEIDERS</p>
          <p class="font-bold text-[#3c8dbc]">AMOUNT</p>
        </div>
      </a>

      <a href="" class="flex rounded-sm border shadow-md">
        <iconify-icon icon="fa6-solid:building" class="bg-[#0073b7] self-center px-9 py-6 text-5xl text-white"></iconify-icon>
        <div class="bg-white px-3 py-2 text-[#3c8dbc] font-medium">
          <p>AFDELINGEN</p>
          <p id="afdelingen" class="font-bold text-[#3c8dbc]">AMOUNT</p>
        </div>
      </a>

      <a href="" class="flex rounded-sm border shadow-md">
        <iconify-icon icon="fa6-solid:info" class="bg-[#dd4b39] self-center px-11 py-6 text-5xl text-white"></iconify-icon>
        <div class="bg-white px-3 py-2 text-[#3c8dbc] font-medium">
          <p>NIEUWTJES</p>
          <p class="font-bold text-[#3c8dbc]">AMOUNT</p>
        </div>
      </a>
    </div>
  </main>
</body>

</html>