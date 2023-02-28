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
          <h1 class="text-2xl">Client toevoegen</h1>
          <form action="{{ route('clients.store') }}" method="POST" class="flex flex-col mt-3">
            @csrf
            @method('POST')

            <x-errormessage />

            <x-form-input name="firstname" text="Voornaam" />
            <x-form-input name="surname" text="Achternaam" />
            <x-form-input name="email" text="Email" type="email" />
            <x-form-input name="password" text="Wachtwoord" type="password" />
            <x-form-input name="birthdate" text="Geboortedatum" type="date" />

            <label for="gender" class="font-bold">Geslacht</label>
            <select name="gender" id="gender" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-5">
              <option value="man">Man</option>
              <option value="woman">Vrouw</option>
            </select>

            <hr>
            
            <div class="flex flex-row gap-5">
              <div class="flex items-center gap-3 mt-3 mb-3">
                <label for="department" class="font-bold">Afdeling</label>
              </div>

              <div class="flex items-center gap-3 mt-3 mb-3">
                <label for="mentors" class="font-bold">Begeleiders</label>
              </div>
              <button onclick="addDepartment()">
                <iconify-icon icon="fa6-solid:plus" class="text-[#3c8dbc] text-xl cursor-pointer" />
              </button>
            </div>


            <div class="flex flex-row gap-5">    
              <div class="flex items-center mb-5">
                <select onchange="getDepartments({{ $departmentLists }}, {{ $mentors }})" name="department" id="department" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                  <option value="">Kies de Afdeling</option>
                  @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                  @endforeach
                </select>
              </div>
  
              <div class="flex items-center mb-5">
                <select name="mentors" id="mentors" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc]">
                  <option value="">Kies een begeleider</option>
                  @foreach ($mentors as $mentor)
                    <option value="{{ $mentor->id }}">{{ $mentor->firstname }} {{ $mentor->surname }}</option>
                  @endforeach
                </select> 
                <a href="#" class="text-[#3c8dbc] ml-2">Verwijder</a>
              </div>
            </div>

            <hr>
            <x-contactgegevens />
            <div class="flex gap-5">
              <x-form-button text="Aanmaken" />
              <x-form-button text="Annuleren" link="clients.index" />
            </div>
        </form>
        </div>
      </div>
    </div>
  </main>
</body>

<script>

  var selectedDepartments = [];
  
  function getDepartments(departmentLists, allMentors) {
    
    selectedDepartments = document.getElementById('department').value;
    var mentorDropdown = document.getElementById('mentors');
    var departments = []
    var mentors = []

    // Loop through the departmentLists array
    for (let i = 0; i < departmentLists.length; i++){
      // search for the selected departmentLists with only Mentors and Department Heads
      if (departmentLists[i].department_id == selectedDepartments && departmentLists[i].role_id != 2){
        // Push the user_id to the mentors array
        mentors.push(departmentLists[i].user_id)
      }
    }
    
    //Delete all options in the mentorDropdown
    while (mentorDropdown.firstChild) {
      mentorDropdown.removeChild(mentorDropdown.firstChild);
    }
    // Make new standard option
    var option = document.createElement('option');
    option.value = '';
    option.text = 'Kies een begeleider';
    mentorDropdown.appendChild(option)
    
    // Loop through the allMentors array
    for( let i = 0; i < allMentors.length; i++){
      if( mentors.includes(allMentors[i].id) ){
        // make new option
        var option = document.createElement('option');
        option.value = allMentors[i].id;
        option.text = allMentors[i].firstname + ' ' + allMentors[i].surname;
        mentorDropdown.appendChild(option);
      }
    }
  }

  function addDepartment() {
    
  }

  </script>
  </html>