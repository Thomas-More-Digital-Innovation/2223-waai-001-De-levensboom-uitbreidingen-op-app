@vite('resources/css/app.css')
<script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
<div class="min-h-[56px] bg-[#3c8dbc] flex justify-end items-center text-white">
    <button onclick="document.getElementById('dropdown').classList.toggle('hidden');" class="text-white hover:bg-[#337ab7] block p-4" type="button">{{ $user->firstname . ' ' . $user->surname}}</button>
    <!-- Dropdown menu -->
    <div id="dropdown" class="z-10 absolute right-0 mx-5 w-52 top-16 shadow-lg bg-white rounded-md border-gray-500 border hidden">
        <ul class="py-2 text-sm text-black " aria-labelledby="dropdownDefaultButton">
            <li>
                <a href="{{ route('user.index') }}" class="block px-4 py-2 hover:bg-gray-200">Manage Account</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }} " >
                    @csrf
                    @method("POST")
        
                    <button type="submit" class="block px-4 py-2 hover:bg-gray-200 w-full text-left">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </li>
        </ul>
    </div>

</div>