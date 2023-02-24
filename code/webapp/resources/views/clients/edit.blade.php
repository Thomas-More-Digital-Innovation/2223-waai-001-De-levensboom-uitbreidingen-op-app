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

            <label for="firstname" class="font-bold">Voornaam*</label>
            <input type="text" name="firstname" id="firstname" required placeholder="Enter voornaam" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->firstname }}>
            
            <label for="surname" class="font-bold">Achternaam*</label>
            <input type="text" name="surname" id="surname" required placeholder="Enter achternaam" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->surname }}>


            <label for="email" class="font-bold">Email*</label>
            <input type="text" name="email" id="email" disabled placeholder="Enter email" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->email }}>


            <label for="birthdate" class="font-bold">Geboortedatum*</label>
            <input type="text" name="birthdate" id="birthdate" required placeholder="Enter geboortedatum Vb: 1989-05-19" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->birthdate }}>

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
            <p class="mt-5 text-lg mb-3">Contactgegevens &lpar;optioneel&rpar;</p>
            <label for="street" class="font-bold">Straat</label>
            <input type="text" name="street" id="street" placeholder="Enter straat" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->street }}>

            <label for="houseNumber" class="font-bold">Huis nummer</label>
            <input type="text" name="houseNumber" id="houseNumber" placeholder="Enter huis nummer" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->houseNumber }}>

            <label for="city" class="font-bold">Woonplaats</label>
            <input type="text" name="city" id="city" placeholder="Enter woonplaats" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->city }}>

            <label for="zipcode" class="font-bold">Postcode</label>
            <input type="text" name="zipcode" id="zipcode" placeholder="Enter postcode" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->zipcode }}>

            <label for="phoneNumber" class="font-bold">Telefoonnummer</label>
            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Enter telefoonnummer" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value={{ $client->phoneNumber }}>
            
            <button type="submit" class="bg-[#3c8dbc] rounded mr-auto px-4 py-1 mt-5 text-white">Wijzigen</button>
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
    var nrOfDep == 0;
    
  }

  </script>

</html>