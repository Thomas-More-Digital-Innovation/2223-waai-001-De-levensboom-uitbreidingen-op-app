<div class="hidden fixed w-full h-full z-10 left-0 top-0 overflow-auto" id="addClient">
    <div class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 bg-white py-4 px-6 rounded-lg w-1/3">
        <div class="flex items-center justify-between mb-1">
            <p class="text-xl">Client toevoegen</p>
            <iconify-icon icon="fa6-solid:xmark" class="text-3xl text-red-500 cursor-pointer" onClick='document.getElementById("addClient").classList.add("hidden")'></iconify-icon>
        </div>
        <hr>
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