@extends('layout')
<title>Waaiburg - Begeleiders</title>
@section('content')
    <h1 class="text-2xl">Begeleider toevoegen</h1>
    <form action="{{ route('mentors.store') }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('POST')

        <x-errormessage />

        <x-form-input name="firstname" text="Voornaam" />
        <x-form-input name="surname" text="Achternaam" />
        <x-form-input name="email" text="Email" />
        <x-form-input name="type" text="Admin" type="checkbox" required="false" />
        <hr />

        <div id="dropdowns">
            <div id="0" class="flex flex-row gap-5">
                <div>
                    <div class="flex items-center gap-3 mt-3 mb-3">
                        <label for="role0" class="font-bold">Functie</label>
                    </div>
                    <select name="role0" id="role0" class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3">
                        <option value="">Kies een Functie</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <div class="flex items-center gap-3 mt-3 mb-3">
                        <label for="department0" class="font-bold">Afdeling</label>
                        <iconify-icon icon="fa6-solid:plus" class="text-wb-blue text-xl cursor-pointer"
                            onclick="addDepartment()" />
                    </div>
                    <div class="flex items-center mb-3">
                        <select name="department0" id="department0"
                            class="border border-[#d2d6de] px-4 py-2 outline-wb-blue">
                            <option value="">Kies een Afdeling</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <button onclick="deleteDepartment( '${nrOfDep}' )" class="text-wb-blue ml-2">Verwijder</button>
                    </div>
                </div>
            </div>
        </div>

        <input name="totalDep" id="totalDep" value="1" class="hidden" />
        <hr />
        <x-contactgegevens />

        <div class="flex gap-5">
            <x-form-button text="Aanmaken" />
            <x-form-button text="Annuleren" link="mentors.index" />
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        let nrOfDep = 1;

        function addDepartment() {
            nrOfDep++;

            let dropdowns = document.getElementById('dropdowns');
            let totalDep = document.getElementById('totalDep');

            let newDropdown = `<div id="${nrOfDep}" class="flex flex-row gap-5">
                          <select name="role${nrOfDep}" id="role${nrOfDep}" class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3">
                            <option value="">Kies een Functie</option>
                            @foreach ($roles as $role)
                              <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                          </select>
              
                          <div class="flex items-center mb-3">
                            <select name="department${nrOfDep}" id="department${nrOfDep}" class="border border-[#d2d6de] px-4 py-2 outline-wb-blue">
                              <option value="">Kies een Afdeling</option>
                              @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                              @endforeach
                            </select>
                            <button onclick="deleteDepartment( '${nrOfDep}' )" class="text-wb-blue ml-2">Verwijder</button>
                          </div>
                        </div>`;

            dropdowns.insertAdjacentHTML('beforeend', newDropdown);
            totalDep.value = nrOfDep;
        }

        function deleteDepartment(departmentId) {
            let dropdowns = document.getElementById('dropdowns');
            dropdowns.removeChild(document.getElementById(departmentId));
        }
    </script>
@endsection
