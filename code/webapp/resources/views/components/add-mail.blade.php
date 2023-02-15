<div class="hidden fixed w-full h-full z-10 left-0 top-0 overflow-auto" id="addMail">
    <div class="absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 bg-white py-4 px-6 rounded-lg w-1/3">
        <div class="flex items-center justify-between mb-1">
            <p class="text-xl">Mail toevoegen</p>
            <iconify-icon icon="fa6-solid:xmark" class="text-3xl text-red-500 cursor-pointer" onClick='document.getElementById("addMail").classList.add("hidden")'></iconify-icon>
        </div>
        <hr>
        <form action="" class="flex flex-col mt-3">
            <label for="subject" class="font-bold">Onderwerp*</label>
            <input type="text" name="subject" id="subject" placeholder="Enter onderwerp" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
            
            <label for="text" class="font-bold">Inhoud*</label>
            <input type="text" name="text" id="text" placeholder="Enter inhoud" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">

            <button type="submit" class="bg-[#3c8dbc] rounded mr-auto px-4 py-1 mt-5 text-white">Toevoegen</button>
        </form>
    </div>
</div>