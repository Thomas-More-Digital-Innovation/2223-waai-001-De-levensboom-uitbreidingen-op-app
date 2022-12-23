
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
    <div class="m-5">
      <div class="flex gap-2 items-end">
        <h1 class="text-2xl">Dashboard</h1>
        <p class="font-[300]">Welcome to Admin Dashboard</p>
      </div>

      <div class="grid grid-cols-3 gap-5">

        <a class="flex rounded-sm bg-white border shadow-md md:w-[260px] h-[90px]">
          <div class="bg-[#00a65a] ">
            <iconify-icon icon="fa6-solid:users" class="min-w-[80px] mx-auto md:h-auto hover:cursor-pointer"></iconify-icon>
          </div>
          <div class="flex flex-col mx-2">
            <h3 class="">CLIENTEN</h3>
            <p>{{ \App\Models\User::count(); }}</p>
          </div>
        </a>

        <a class="flex rounded-sm bg-white border shadow-md md:w-[260px] h-[90px]">
          <div class="bg-[#ff851b] object-cover min-w-[80px] md:h-auto"> Font Awesome? </div>
          <div class="flex flex-col mx-2">
            <h3 class="">BEGELEIDERS</h3>
            <p>{{ \App\Models\User::count(); }}</p>
          </div>
        </a>

        <a class="flex rounded-sm bg-white border shadow-md md:w-[260px] h-[90px]">
          <div class="bg-[#0073b7] object-cover min-w-[80px] md:h-auto"> Font Awesome? </div>
          <div class="flex flex-col mx-2">
            <h3 class="">AFDELINGEN</h3>
            <p>{{ \App\Models\Department::count(); }}</p>
          </div>
        </a>

        <a class="flex rounded-sm bg-white border shadow-md md:w-[260px] h-[90px]">
          <div class="bg-[#dd4b39] object-cover min-w-[80px] md:h-auto"> Font Awesome? </div>
          <div class="flex flex-col mx-2">
            <h3 class="">NIEUWTJES</h3>
            <p>{{ \App\Models\Info::count(); }}</p>
          </div>
        </a>
      </div>
    </div>
  </main>
</body>
</html>