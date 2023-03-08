<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
  <title>Waaiburg - Clienten</title>
</head>

<body class="flex relative">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <h1 class="text-2xl">Client wijzigen</h1>
          <form action="{{ route('clients.update', $client->id) }}" method="POST" class="flex flex-col mt-3">
            @csrf
            @method('PATCH')

            <x-errormessage />

            <x-form-input name="firstname" text="Voornaam" :value="$client" />
            <x-form-input name="surname" text="Achternaam" :value="$client" />
            <x-form-input name="email" text="Email" type="email" :value="$client" />
            <x-form-input name="birthdate" text="Geboortedatum" type="date" :value="$client" />
  
            <label for="gender" class="font-bold">Geslacht</label>
            <select name="gender" id="gender" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-5">
              <option value="man">Man</option>
              <option value="woman">Vrouw</option>
            </select>
            <hr>

            <div id='dropdowns'>
              @for ($i = 0; $i < (count($userDepartments) ? count($userDepartments) : 1); $i++)
                <div id='{{ $i }}'>
                  <div class="flex flex-row gap-5">    
                    <div>
                      @if ( $i == 0)
                      <div class="flex items-center gap-3 mt-3 mb-3">
                        <label for="department{{ $i }}" class="font-bold">Afdeling</label>
                      </div>
                      @endif
                      <select onchange="getDepartments({{ $departmentsList }}, {{ $mentors }}, 'department{{ $i }}', 'mentors{{ $i }}')" name="department{{ $i }}" id="department{{ $i }}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                        <option value="">Kies een Afdeling</option>
                        @foreach ($departments as $department)
                          <option value="{{ $department->id }}"
                            @if ($department->id == (count($userDepartments) ? $userDepartments[$i]->department_id : 0))
                              selected
                            @endif
                            >
                            {{ $department->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
        
                    <div>
                      @if ( $i == 0)
                        <div class="flex items-center gap-3 mt-3 mb-3">
                          <label for="mentors{{ $i }}" class="font-bold">Begeleiders</label>
                          <iconify-icon icon="fa6-solid:plus" class="text-[#3c8dbc] text-xl cursor-pointer" onclick="addDepartment()"/>
                        </div>
                      @endif
                      <div class="flex items-center mb-3">
                        <select name="mentors{{ $i }}" id="mentors{{ $i }}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                          <option value="">Kies een Begeleider</option>
                          @foreach ($mentors as $mentor)
                            <option value="{{ $mentor->id }}">{{ $mentor->firstname }} {{ $mentor->surname }}</option>
                          @endforeach
                        </select>
                        @if ( $i != 0 )
                          <button onclick="deleteDepartment( '{{ $i }}' )" class="text-[#3c8dbc] ml-2">Verwijder</button>
                        @endif
                      </div> 
                    </div>
                  </div>
                </div>
              @endfor
            </div>

            <input name="totalDep" id="totalDep" value="1" class="hidden" />
            <hr>
            <x-contactgegevens :contactgegevens="$client" />

            <div class="flex gap-5">
              <x-form-button text="Wijzigen" />
              <x-form-button text="Annuleren" link="clients.index" />
            </div>
        </form>
        </div>
      </div>
    </div>

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#f39c12]">
        <div class="m-3">
          <h1 class="text-2xl">Tevredenheids meting</h1>
          <p class="mt-5 mb-7">Een tevredenheids meting is reeds verstuurd naar deze client</p>
          <a href="{{ route("clients.index") }}" class="bg-[#f39c12] rounded px-4 py-2 mt-5 text-white">Tevredenheids meting versturen</a>
        </div>
      </div>
    </div>
  </main>
</body>

<script>
  let nrOfDep = 1;

  function getDepartments(departmentsList, allMentors, departmentId, mentorsId) {
    selectedDepartments = document.getElementById(departmentId).value;
    let mentorDropdown = document.getElementById(mentorsId);
    let departments = []
    let mentors = []

    // Loop through the departmentsList array
    for (let i = 0; i < departmentsList.length; i++){
      // search for the selected departmentsList with only Mentors and Department Heads
      if (departmentsList[i].department_id == selectedDepartments && departmentsList[i].role_id != 2){
        // Push the user_id to the mentors array
        mentors.push(departmentsList[i].user_id)
      }
    }
    
    //Delete all options in the mentorDropdown
    while (mentorDropdown.firstChild) {
      mentorDropdown.removeChild(mentorDropdown.firstChild);
    }
    // Make new standard option
    let option = document.createElement('option');
    option.value = '';
    option.text = 'Kies een Begeleider';
    mentorDropdown.appendChild(option)
    
    // Loop through the allMentors array
    for( let i = 0; i < allMentors.length; i++){
      if( mentors.includes(allMentors[i].id) ){
        // make new option
        let option = document.createElement('option');
        option.value = allMentors[i].id;
        option.text = allMentors[i].firstname + ' ' + allMentors[i].surname;
        mentorDropdown.appendChild(option);
      }
    }
  }

  function addDepartment() {
    nrOfDep++;

    let dropdowns = document.getElementById('dropdowns');
    let totalDep = document.getElementById('totalDep');

    let newDropdown =  `<div id='${nrOfDep}' class="flex flex-row gap-5">    
                          <div class="flex items-center mb-5">
                            <select onchange="getDepartments({{ $departmentsList }}, {{ $mentors }}, 'department${nrOfDep}', 'mentors${nrOfDep}')" name="department${nrOfDep}" id="department${nrOfDep}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                              <option value="">Kies een Afdeling</option>
                              @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="flex items-center mb-5">
                            <select name="mentors${nrOfDep}" id="mentors${nrOfDep}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                              <option value="">Kies een Begeleider</option>
                            </select> 
                            <button onclick="deleteDepartment( '${nrOfDep}' )" class="text-[#3c8dbc] ml-2">Verwijder</button>
                          </div>
                        </div>`;

    dropdowns.insertAdjacentHTML('beforeend', newDropdown);
    totalDep.value = nrOfDep;
  }

  function deleteDepartment( departmentId ) {
    let dropdowns = document.getElementById('dropdowns');
    dropdowns.removeChild(document.getElementById(departmentId));
  }

</script>

</html>