<div class="hidden fixed w-full h-full z-10 left-0 top-0 overflow-auto" id="addNew">
    <div class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 bg-white py-4 px-6 rounded-lg w-1/3">
        <div class="flex items-center justify-between mb-1">
            <p class="text-xl">Nieuwtje toevoegen</p>
            <iconify-icon icon="fa6-solid:xmark" class="text-3xl text-red-500 cursor-pointer" onClick='document.getElementById("addNew").classList.add("hidden")'></iconify-icon>
        </div>
        <hr>
        <form action="" class="flex flex-col mt-3">
            <label for="title" class="font-bold">Titel*</label>
            <input type="text" name="title" id="title" placeholder="Enter titel" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
           
            <label for="shorttext" class="font-bold">Korte inhoud</label>
            <input type="text" name="shorttext" id="shorttext" placeholder="Enter korte inhoud" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            
            <label for="text" class="font-bold">Inhoud</label>
            <input type="text" name="text" id="text" placeholder="Enter inhoud" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">

            <button type="submit" class="bg-[#3c8dbc] rounded mr-auto px-4 py-1 mt-5 text-white">Aanmaken</button>
        </form>
    </div>
</div>