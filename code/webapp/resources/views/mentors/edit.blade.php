<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Begeleiders</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
            <h1 class="text-2xl">Begeleider wijzigen</h1>
            <form action="{{ route('mentors.update', $mentor->id) }}" method="POST" class="flex flex-col mt-3">
                @csrf
                @method('PATCH')

                <x-form-input name="firstname" text="Voornaam" :value="$mentor" />
                <x-form-input name="surname" text="Achternaam" :value="$mentor" />
                <x-form-input name="email" text="Email" :value="$mentor" />
                <hr/>

                <div id="dropdowns">
                  <div id="0" class="flex flex-row gap-5">
                    <div>
                      <div class="flex items-center gap-3 mt-3 mb-3">
                        <label for="role0" class="font-bold">Functie*</label>
                      </div>
                      <select name="role0" id="role0" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">
                        <option value="">Kies een Functie</option>
                        @foreach ($roles as $role)
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div>
                      <div class="flex items-center gap-3 mt-3 mb-3">
                        <label for="department0" class="font-bold">Afdeling</label>
                        <iconify-icon icon="fa6-solid:plus" class="text-[#3c8dbc] text-xl cursor-pointer" onclick="addDepartment()" />
                      </div>
                      <div class="flex items-center mb-3">
                        <select name="department0" id="department0" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                          <option value="">Kies een Afdeling</option>
                          @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                          @endforeach
                        </select>
                        <a href="#" class="text-[#3c8dbc] ml-2">Verwijder</a>
                      </div>
                    </div>
                  </div>
                </div>

                <input name="totalDep" id="totalDep" value="1" class="hidden" />
                <hr/>
                <x-contactgegevens :contactgegevens="$mentor" />
                <x-form-button text="Wijzigen" />
            </form>
        </div>
      </div>
    </div>
  </main>
</body>

<script>
  let nrOfDep = 1;

  function addDepartment() {
    nrOfDep++;

    let dropdowns = document.getElementById('dropdowns');
    let totalDep = document.getElementById('totalDep');

    let newDropdown =  `<div id="${nrOfDep}" class="flex flex-row gap-5">
                          <select name="role${nrOfDep}" id="role${nrOfDep}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">
                            <option value="">Kies een Functie</option>
                            @foreach ($roles as $role)
                              <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                          </select>
              
                          <div class="flex items-center mb-3">
                            <select name="department${nrOfDep}" id="department${nrOfDep}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                              <option value="">Kies een Afdeling</option>
                              @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                              @endforeach
                            </select>
                            <a href="#" class="text-[#3c8dbc] ml-2">Verwijder</a>
                          </div>
                        </div>`;

    dropdowns.insertAdjacentHTML('beforeend', newDropdown);
  }

  function deleteDepartment( departmentId ) {
    let dropdowns = document.getElementById('dropdowns');
    dropdowns.removeChild(document.getElementById(departmentId));
  }

  function fillSelects() {
    // nrOfDep = {{ $departmentList->count() }}
    console.log(@json($departmentList));
    // console.log(nrOfDep.user_id);
    // console.log(nrOfDep.department_id);
    // console.log(nrOfDep.role_id);
    // let role_id = @json($departmentList[0]->role_id);
    // let department_id = @json($departmentList[0]->department_id);
    let allDepartments = @json($departmentList);

    if (allDepartments != null) {
      console.log(allDepartments.values)
      for (let i = 0; i <= nrOfDep; i++) {
        let dropdowns = document.getElementById('dropdowns');
        // let totalDep = document.getElementById('totalDep');
        let thisDepartment = allDepartments[i];
        console.log(thisDepartment.role_id);
        let newDropdown =  `<div id="${i}" class="flex flex-row gap-5">
                              <select name="role${i}" id="role${i}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">
                                <option value="">Kies een Functie</option>
                                @foreach ($roles as $role)
                                  <option value="{{ $role->id }}" {{ ( $role->id == ${thisDepartment.role_id}) ? 'selected' : '' }} >{{ $role->name }}</option>
                                @endforeach
                              </select>

                              <div class="flex items-center mb-3">
                                <select name="department${i}" id="department${i}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                                  <option value="">Kies een Afdeling</option>
                                  @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ ( $department->id == ${thisDepartment.department_id}) ? 'selected' : '' }}>{{ $department->name }}</option>
                                  @endforeach
                                </select>
                                <a href="#" class="text-[#3c8dbc] ml-2">Verwijder</a>
                              </div>
                            </div>`;
        dropdowns.insertAdjacentHTML('beforeend', newDropdown);
      }
    }
  }

  // after the dom is loaded call function fillSelects
  document.addEventListener('DOMContentLoaded', fillSelects());
</script>

</html>