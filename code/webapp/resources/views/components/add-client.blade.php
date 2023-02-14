<div class="hidden fixed w-full h-full z-10 left-0 top-0" id="addClient">
    <div class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 bg-white py-4 px-6 rounded-lg w-1/3">
        <div class="flex items-center justify-between">
            <p>Client toevoegen</p>
            <iconify-icon icon="fa6-solid:xmark" class="text-3xl text-red-500 cursor-pointer" onClick='document.getElementById("addClient").classList.add("hidden")'></iconify-icon>
        </div>
        <hr>
        <div class="flex flex-col">
            <div class="w-1/4">
                <label for="firstname" class="font-bold">Voornaam*</label>
                <input type="text" name="firstname" id="firstname" placeholder="Enter voornaam" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            </div>
            <div class="w-1/4">
                <label for="lastname" class="font-bold">Achternaam*</label>
                <input type="text" name="lastname" id="lastname" placeholder="Enter achternaam" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            </div>
            <div class="w-1/4">
                <label for="email" class="font-bold">Email*</label>
                <input type="text" name="email" id="email" placeholder="Enter email" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            </div>
            <div class="w-1/4">
                <label for="birthdate" class="font-bold">Geboortedatum*</label>
                <input type="text" name="birthdate" id="birthdate" placeholder="Enter geboortedatum Vb: 19-05-1989" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            </div>
            <div class="w-1/4">
                <label for="gender" class="font-bold">Geslacht</label>
                {{-- select --}}
            </div>
            <hr>
            <div class="w-1/4">
                <label for="department" class="font-bold">Afdeling</label>
                {{-- select met toevoegen van meerdere --}}
            </div>
            <hr>
            <div class="w-1/4">
                <label for="mentores" class="font-bold">Begeleiders</label>
                {{-- select met toevoegen van meerdere --}}
            </div>
            <hr>
            <p>Contactgegevens &lpar;optioneel&rpar;</p>
            <div class="w-1/4">
                <label for="street" class="font-bold">Straat</label>
                <input type="text" name="street" id="street" placeholder="Enter straat" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            </div>
            <div class="w-1/4">
                <label for="housenumber" class="font-bold">Huis nummer</label>
                <input type="text" name="housenumber" id="housenumber" placeholder="Enter huis nummer" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            </div>
            <div class="w-1/4">
                <label for="city" class="font-bold">Woonplaats</label>
                <input type="text" name="city" id="city" placeholder="Enter woonplaats" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            </div>
            <div class="w-1/4">
                <label for="zipcode" class="font-bold">Postcode</label>
                <input type="text" name="zipcode" id="zipcode" placeholder="Enter postcode" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            </div>
            <div class="w-1/4">
                <label for="phonenumber" class="font-bold">Telefoonnummer</label>
                <input type="text" name="phonenumber" id="phonenumber" placeholder="Enter telefoonnummer" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            </div>
        </div>
    </div>
</div>