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
          <h1 class="text-2xl">Client toevoegen</h1>
          <form action="" method="POST" class="flex flex-col mt-3">
            @csrf
            @method('POST')

            <label for="firstname" class="font-bold">Voornaam*</label>
            <input type="text" name="firstname" id="firstname" required placeholder="Enter voornaam" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            
            <label for="lastname" class="font-bold">Achternaam*</label>
            <input type="text" name="lastname" id="lastname" required placeholder="Enter achternaam" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">


            <label for="email" class="font-bold">Email*</label>
            <input type="text" name="email" id="email" required placeholder="Enter email" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">


            <label for="birthdate" class="font-bold">Geboortedatum*</label>
            <input type="text" name="birthdate" id="birthdate" required placeholder="Enter geboortedatum Vb: 19-05-1989" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">

            <label for="gender" class="font-bold">Geslacht</label>
            {{-- select --}}

            <hr>
            <label for="department" class="font-bold">Afdeling</label>
            {{-- select met toevoegen van meerdere --}}
            <hr>
            <label for="mentores" class="font-bold">Begeleiders</label>
            {{-- select met toevoegen van meerdere --}}
            <hr>
            <p class="mt-5 text-lg">Contactgegevens &lpar;optioneel&rpar;</p>
            <label for="street" class="font-bold">Straat</label>
            <input type="text" name="street" id="street" placeholder="Enter straat" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">

            <label for="housenumber" class="font-bold">Huis nummer</label>
            <input type="text" name="housenumber" id="housenumber" placeholder="Enter huis nummer" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">

            <label for="city" class="font-bold">Woonplaats</label>
            <input type="text" name="city" id="city" placeholder="Enter woonplaats" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">

            <label for="zipcode" class="font-bold">Postcode</label>
            <input type="text" name="zipcode" id="zipcode" placeholder="Enter postcode" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">

            <label for="phonenumber" class="font-bold">Telefoonnummer</label>
            <input type="text" name="phonenumber" id="phonenumber" placeholder="Enter telefoonnummer" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            <button type="submit" class="bg-[#3c8dbc] rounded mr-auto px-4 py-1 mt-5 text-white">Aanmaken</button>
        </form>
        </div>
      </div>
    </div>
  </main>
</body>

</html>