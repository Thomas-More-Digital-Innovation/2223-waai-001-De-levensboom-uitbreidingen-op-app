<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
  <title>Waaiburg - Clienten</title>
</head>

<body class="flex relative">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <h1 class="text-2xl">Client wijzigen</h1>
          <form action="{{ route('clients.update', $client->id) }}" method="POST" class="flex flex-col mt-3">
            @csrf
            @method('PATCH')

            <label for="firstname" class="font-bold">Voornaam*</label>
            <input type="text" name="firstname" id="firstname" required placeholder="Enter voornaam" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->firstname }}>
            
            <label for="surname" class="font-bold">Achternaam*</label>
            <input type="text" name="surname" id="surname" required placeholder="Enter achternaam" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->surname }}>


            <label for="email" class="font-bold">Email*</label>
            <input type="text" name="email" id="email" disabled placeholder="Enter email" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->email }}>


            <label for="birthdate" class="font-bold">Geboortedatum*</label>
            <input type="text" name="birthdate" id="birthdate" required placeholder="Enter geboortedatum Vb: 1989-05-19" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->birthdate }}>

            <label for="gender" class="font-bold">Geslacht</label>
            <select name="gender" id="gender" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-5">
              <option value="man">Man</option>
              <option value="woman">Vrouw</option>
            </select>

            <hr>

            <div class="flex items-center gap-3 mt-3 mb-3">
              <label for="department" class="font-bold">Afdeling</label>
              <iconify-icon icon="fa6-solid:plus" class="text-[#3c8dbc] text-xl cursor-pointer" />
            </div>

            <div class="flex items-center mb-5">
              <select name="department" id="department" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                <option value=""></option>
                @foreach ($departments as $department)
                  <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
              </select>
              <a href="#" class="text-[#3c8dbc] ml-2">Verwijder</a>
            </div>

            <hr>
            
            <div class="flex items-center gap-3 mt-3 mb-2">
              <label for="mentors" class="font-bold">Begeleiders</label>
              <iconify-icon icon="fa6-solid:plus" class="text-[#3c8dbc] text-xl cursor-pointer" />
            </div>

            <div class="flex items-center mb-5">
              <select name="mentors" id="mentors" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                <option value=""></option>
                @foreach ($mentors as $mentor)
                  <option value="{{ $mentor->id }}">{{ $mentor->firstname }} {{ $mentor->surname }}</option>
                @endforeach
              </select>
              <a href="#" class="text-[#3c8dbc] ml-2">Verwijder</a>
            </div>
            
            <hr>
            <x-contactgegevens :contactgegevens="$client" />
            <button type="submit" class="bg-[#3c8dbc] rounded mr-auto px-4 py-1 mt-5 text-white">Wijzigen</button>
        </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>