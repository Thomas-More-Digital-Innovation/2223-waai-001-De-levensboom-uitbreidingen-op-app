
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
  @if (Hash::check('veranderMij', $currentUser->password))
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 h-full w-full right-0 overflow-x-hidden overflow-y-auto flex items-center justify-center">
      <div class="h-full w-full bg-black absolute opacity-60"></div>
      <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
          <!-- Modal header -->
          <div class="flex items-start justify-between p-4 border-b rounded-t ">
            <h3 class="text-xl font-semibold text-gray-900">
                Verander je wachtwoord!
            </h3>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
            <p class="text-base leading-relaxed text-gray-500">
              Je wachtwoord is onveilig!
            </p>
            <p class="text-base leading-relaxed text-gray-500">
              Je kan het veranderen in <a href="/user#Pass" class="text-blue-500 underline hover:text-blue-900">Beheer account</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  @endif
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar/>
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
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf" />
  </main>
</body>

</html>