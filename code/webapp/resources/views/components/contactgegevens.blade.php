@if ($contactgegevens != null)
    <p class="mt-5 text-lg mb-3">Contactgegevens &lpar;optioneel&rpar;</p>
    <label for="street" class="font-bold">Straat</label>
    <input type="text" name="street" id="street" placeholder="Geef je straat in"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3" value="{{ $contactgegevens->street }}">

    <label for="houseNumber" class="font-bold">Huis nummer</label>
    <input type="text" name="houseNumber" id="houseNumber" placeholder="Geef je huis nummer in"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3" value="{{ $contactgegevens->houseNumber }}">

    <label for="city" class="font-bold">Woonplaats</label>
    <input type="text" name="city" id="city" placeholder="Geef je woonplaats in"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3" value="{{ $contactgegevens->city }}">

    <label for="zipcode" class="font-bold">Postcode</label>
    <input type="text" name="zipcode" id="zipcode" placeholder="Geef je postcode in"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3" value="{{ $contactgegevens->zipcode }}">

    <label for="phoneNumber" class="font-bold">Telefoonnummer</label>
    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Geef je telefoonnummer in"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3" value="{{ $contactgegevens->phoneNumber }}">
@else
    <p class="mt-5 text-lg mb-3">Contactgegevens &lpar;optioneel&rpar;</p>
    <label for="street" class="font-bold">Straat</label>
    <input type="text" name="street" id="street" placeholder="Geef je straat"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3">

    <label for="houseNumber" class="font-bold">Huis nummer</label>
    <input type="text" name="houseNumber" id="houseNumber" placeholder="Geef je huis nummer in"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3">

    <label for="city" class="font-bold">Woonplaats</label>
    <input type="text" name="city" id="city" placeholder="Geef je woonplaats in"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3">

    <label for="zipcode" class="font-bold">Postcode</label>
    <input type="text" name="zipcode" id="zipcode" placeholder="Geef je postcode in"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3">

    <label for="phoneNumber" class="font-bold">Telefoonnummer</label>
    <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Geef je telefoonnummer in"
        class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3">
@endif
