
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
  <title>Waaiburg - Dashboard</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="grid grid-cols-3 gap-5 m-5">
      <a href="/clients" class="flex rounded-sm border shadow-md bg-white">
        <iconify-icon icon="fa6-solid:users" class="bg-[#00a65a] self-center p-6 text-5xl text-white"></iconify-icon>
        <div class=" px-3 py-2 text-[#3c8dbc] font-medium">
          <p>CLIENTEN</p>
          <p class="font-bold text-[#3c8dbc]">{{ $clientcount }}</p>
        </div>
      </a>
      
      <a href="/mentors" class="flex rounded-sm border shadow-md bg-white">
        <iconify-icon icon="fa6-solid:address-card" class="bg-[#ff851b] self-center px-7 py-6 text-5xl text-white"></iconify-icon>
        <div class="px-3 py-2 text-[#3c8dbc] font-medium">
          <p>BEGELEIDERS</p>
          <p class="font-bold text-[#3c8dbc]">{{ $mentorcount }}</p>
        </div>
      </a>

      <a href="/departments" class="flex rounded-sm border shadow-md bg-white">
        <iconify-icon icon="fa6-solid:building" class="bg-[#0073b7] self-center px-9 py-6 text-5xl text-white"></iconify-icon>
        <div class="px-3 py-2 text-[#3c8dbc] font-medium">
          <p>AFDELINGEN</p>
          <p class="font-bold text-[#3c8dbc]">{{ $departmentcount }}</p>
        </div>
      </a>

      <a href="/news" class="flex rounded-sm border shadow-md bg-white">
        <iconify-icon icon="fa6-solid:info" class="bg-[#dd4b39] self-center px-11 py-6 text-5xl text-white"></iconify-icon>
        <div class="px-3 py-2 text-[#3c8dbc] font-medium">
          <p>NIEUWTJES</p>
          <p class="font-bold text-[#3c8dbc]">{{ $newscount }}</p>
        </div>
      </a>
    </div>
  </main>
</body>

</html>