<!doctype html>
<html lang="nl">

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
          <x-list-title title="Clienten lijst" name="clients.create" />
          <table class="border-collapse border border-[#f4f4f4] w-full">
            <thead>
              <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Voornaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Achternaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Afdeling&lpar;en&rpar;</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Begeleider&lpar;s&rpar;</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Geboortedatum</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Contactgegevens</th>
                <th class="border border-[#f4f4f4] py-2 px-">Acties</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clients as $client)
              <tr class="font-normal">
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->firstname }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->surname }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left">
                  @foreach ($departmentLists as $departmentList)
                      @if ($departmentList->where('user_id', $client->id)->doesntExist())
                        <p>Geen afdeling</p>
                        @break
                      @endif
                      @foreach ($departments as $department)
                        @if ($departmentList->department_id == $department->id && $departmentList->user_id == $client->id)
                          <p>{{ $department->name }}</p>
                        @endif
                      @endforeach
                  @endforeach
                </td>
                <td class="border border-[#f4f4f4] py-2 px-6">
                  @foreach ($userLists as $userList)
                    @if ($userList->where('client_id', $client->id)->doesntExist())
                      <p>Geen begeleider</p>
                      @break
                    @endif
                    @foreach ($mentors as $mentor)
                      @if ($userList->mentor_id == $mentor->id && $userList->client_id == $client->id)
                        <p>-{{ $mentor->firstname . ' ' . $mentor->surname }}</p>
                      @endif
                    @endforeach
                  @endforeach
                </td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->birthdate }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->street . ' ' .  $client->houseNumber }} <br> {{ $client->city . ' ' . $client->zipcode}}  <br> {{ $client->phoneNumber }} <br> {{ $client->email }} </td>
                <td class="border border-[#f4f4f4] py-2 px-6">
                  <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                    @csrf
                    @method('delete')

                    <a href="{{ route('clients.edit', $client->id) }}" class="text-[#3c8dbc]">Bewerk</a>
                    <span>|</span>

                    <button type="submit" class="text-[#3c8dbc]" onclick="return confirm('Ben je zeker dat je deze client wilt verwijderen?');">Verwijder</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=3" text="documentatie over clienten" />
  </main>
</body>

</html>