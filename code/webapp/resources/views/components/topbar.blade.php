@vite('resources/css/app.css')
<script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"
    integrity="sha384-Wg6YZl1ug3L+m2P1dI9UyM3bbDxm861GXqDX7y1TetknKz8/0AoMTJT0Ktlm2Tgi" crossorigin="anonymous">
</script>
<div class="min-h-[57px] bg-wb-blue flex justify-end items-center text-white">
    <button onclick="document.getElementById('dropdown').classList.toggle('hidden');"
        class="text-white hover:bg-[#337ab7] block p-4"
        type="button">{{ $user->firstname . ' ' . $user->surname }}</button>
    <!-- Dropdown menu -->
    <div id="dropdown"
        class="z-10 absolute right-0 mx-5 w-52 top-16 shadow-lg bg-white rounded-md border-gray-500 border hidden">
        <ul class="py-2 text-sm text-black " aria-labelledby="dropdownDefaultButton">
            <li>
                <a href="{{ route('user.index') }}" class="block px-4 py-2 hover:bg-gray-200">Beheer account</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }} ">
                    @csrf
                    @method('POST')

                    <button type="submit" class="block px-4 py-2 hover:bg-gray-200 w-full text-left">
                        Uitloggen
                    </button>
                </form>
            </li>
        </ul>
    </div>

</div>
