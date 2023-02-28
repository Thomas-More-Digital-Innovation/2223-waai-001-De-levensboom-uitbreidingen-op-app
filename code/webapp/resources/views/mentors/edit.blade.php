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

                <x-errormessage />

                <x-form-input name="firstname" text="Voornaam" :value="$mentor" />
                <x-form-input name="surname" text="Achternaam" :value="$mentor" />
                <x-form-input name="email" text="Email" :value="$mentor" />
                <hr/>

                <div id="dropdowns">
                  <div id="0" class="flex flex-row gap-5">
                    <div>
                      <div class="flex items-center gap-3 mt-3 mb-3">
                        <label for="role" class="font-bold">Functie*</label>
                      </div>
                      @foreach ($departmentsList as $departmentList)
                        <div class="flex items-center">
                          <select name="role{{ $loop->index }}" id="role{{ $loop->index }}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">
                            <option value="">Kies een Functie</option>
                            @foreach ($roles as $role)
                              <option value="{{ $role->id }}" 
                                @if ($role->id == $departmentList->role_id)
                                  selected
                                @endif
                              >
                                {{ $role->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      @endforeach
                    </div>
                    <div>
                      <div class="flex items-center gap-3 mt-3 mb-3">
                        <label for="department" class="font-bold">Afdeling</label>
                        <iconify-icon icon="fa6-solid:plus" class="text-[#3c8dbc] text-xl cursor-pointer" onclick="addDepartment()" />
                      </div>
                      @foreach ($departmentsList as $departmentList)
                        <div class="flex items-center mb-3">
                          <select name="department{{ $loop->index }}" id="department{{ $loop->index }}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                            <option value="">Kies een Afdeling</option>
                            @foreach ($departments as $department)
                              <option value="{{ $department->id }}" 
                                @if ($department->id == $departmentList->department_id)
                                  selected
                                @endif
                              >
                                {{ $department->name }}
                              </option>
                            @endforeach
                          </select>
                          <a href="#" class="text-[#3c8dbc] ml-2">Verwijder</a>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>

                <input name="totalDep" id="totalDep" value="1" class="hidden" />
                <hr/>
                <x-contactgegevens :contactgegevens="$mentor" />

                <div class="flex gap-5">
                  <x-form-button text="Wijzigen" />
                  <x-form-button text="Annuleren" link="mentors.index" />
                </div>
            </form>
        </div>
      </div>
    </div>
  </main>
</body>

<script>
  var nrOfDep = 1;

  function addDepartment() {
    nrOfDep++;

    var dropdowns = document.getElementById('dropdowns');
    var totalDep = document.getElementById('totalDep');

    var newDropdown =  `<div id="${nrOfDep}" class="flex flex-row gap-5">
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
    var dropdowns = document.getElementById('dropdowns');

    dropdowns.removeChild(document.getElementById(departmentId));
  }
</script>

</html>