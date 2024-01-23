@extends('layout')
<title>Waaiburg - Begeleiders</title>
@section('content')
    <h1 class="text-2xl">Begeleider wijzigen</h1>
    <form action="{{ route('mentors.update', $mentor->id) }}" method="POST" onsubmit="return checkRoleChanges(event)"
        class="flex flex-col mt-3" id="mentorForm">
        @csrf
        @method('PATCH')

        <x-errormessage />

        <x-form-input name="firstname" text="Voornaam" :value="$mentor" />
        <x-form-input name="surname" text="Achternaam" :value="$mentor" />
        <x-form-input name="email" text="Email" :value="$mentor" />
        <x-form-input name="type" text="Admin" type="checkbox" required="false" :value="$mentor" />
        <hr />

        <div id="dropdowns">
            @for ($i = 0; $i < (count($departmentsList) ? count($departmentsList) : 1); $i++)
                <div id="{{ $i }}" class="flex flex-row gap-5">
                    <div>
                        @if ($i == 0)
                            <div class="flex items-center gap-3 mt-3 mb-3">
                                <label for="role{{ $i }}" class="font-bold">Functie</label>
                            </div>
                        @endif
                        <div class="flex items-center">
                            <select name="role{{ $i }}" id="role{{ $i }}"
                                class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3">
                                <option value="">Kies een Functie</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if ($role->id == (count($departmentsList) ? $departmentsList[$i]->role_id : 0)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        @if ($i == 0)
                            <div class="flex items-center gap-3 mt-3 mb-3">
                                <label for="department0" class="font-bold">Afdeling</label>
                                <iconify-icon icon="fa6-solid:plus" class="text-wb-blue text-xl cursor-pointer"
                                    onclick="addDepartment()" />
                            </div>
                        @endif
                        <div class="flex items-center mb-3">
                            <select name="department{{ $i }}" id="department{{ $i }}"
                                class="border border-[#d2d6de] px-4 py-2 outline-wb-blue">
                                <option value="">Kies een Afdeling</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" @if ($department->id == (count($departmentsList) ? $departmentsList[$i]->department_id : 0)) selected @endif>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($i != 0)
                                <button onclick="deleteDepartment( '{{ $i }}' )"
                                    class="text-wb-blue ml-2">Verwijder</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <input name="totalDep" id="totalDep" value="{{ count($departmentsList) ? count($departmentsList) : 1 }}"
            class="hidden" />
        <hr />
        <x-contactgegevens :contactgegevens="$mentor" />

        <div class="flex gap-5">
            <x-form-button text="Wijzigen" />
            <x-form-button text="Annuleren" link="mentors.index" />
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        let nrOfDep = 1;

        function setDepartments(nrOfDepartments) {
            nrOfDep = nrOfDepartments;
        }

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

        function checkRoleChanges(event) {
            let adminCheckbox = document.getElementById('type');
            let originalAdminValue = @json($mentor->user_type_id);

            let adminChanged = (originalAdminValue === 1 && !adminCheckbox.checked) || (originalAdminValue !== 1 &&
                adminCheckbox.checked);

            let form = document.getElementById('mentorForm');
            form.action = "{{ route('mentors.update', $mentor->id) }}";

            if (adminChanged) {
                if (!confirm(
                        "Let op: Je hebt de admin-status gewijzigd ten opzichte van wat is opgeslagen. Weet je zeker dat je wilt doorgaan?"
                        )) {
                    // Stop the form submission
                    event.preventDefault();
                    event.stopPropagation();
                }
            }
        }
    </script>
@endsection
