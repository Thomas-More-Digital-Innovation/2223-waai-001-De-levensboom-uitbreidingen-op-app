<div id="defaultModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 h-full w-full right-0 overflow-x-hidden overflow-y-auto flex items-center justify-center">
    <div class="h-full w-full bg-black absolute opacity-60"></div>
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t ">
                <h3 class="text-xl font-semibold text-gray-900">
                    Ben je zeker dat je dit wilt verwijderen?
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <p class="text-base leading-relaxed text-gray-500">
                    Deze actie kan niet ongedaan worden gemaakt!
                </p>
                <div class="flex gap-2 justify-end">
                    <a href="{{ route('departments.index', ['show' => false]) }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                        Annuleren
                    </a>
                    <a href="{{ route('departments.destroy', $department) }}"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                        Verwijderen
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
