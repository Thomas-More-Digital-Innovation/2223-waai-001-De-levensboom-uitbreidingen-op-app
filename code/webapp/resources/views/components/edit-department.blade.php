<div class="hidden fixed w-full h-full z-10 left-0 top-0">
    <div class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 bg-white py-4 px-6 rounded-lg w-1/3">
        <p class="text-xl">Afdeling wijzigen</p>
        <hr>
        <form action="{{ route('department.update', $department->id) }}" method="POST" class="flex flex-col mt-3">
            @csrf
            @method('POST')

            <label for="name" class="font-bold">Naam*</label>
            <input type="text" name="name" id="name" required class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]" value={{ $department->name }}>

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
            <button type="submit" class="bg-[#3c8dbc] rounded mr-auto px-4 py-1 mt-5 text-white">Bewerk</button>
        </form>
    </div>
</div>