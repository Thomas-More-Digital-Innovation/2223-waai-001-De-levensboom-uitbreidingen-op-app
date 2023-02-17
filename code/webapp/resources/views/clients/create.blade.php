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
          <x-list-title title="Clienten lijst" name="clients.create" />
          <table class="border-collapse border border-[#f4f4f4] table-auto">
            <thead>
              <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Voornaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Achternaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Afdeling&lpar;en&rpar;</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Begeleider&lpar;s&rpar;</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Geboortedatum</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Contactgegevens</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clients as $client)
              <tr class="font-normal">
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->firstname }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->lastname }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->afdeling }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->begeleider }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->birthdate }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->street . ' ' .  $client->houseNumber }} <br> {{ $client->city . ' ' . $client->zipcode}}  <br> {{ $client->phoneNumber }} </td>
                <td class="border border-[#f4f4f4] py-2 px-6">
                  <a href="" class="text-[#3c8dbc]">Bewerk</a>
                  <span>|</span>
                  <a href="" class="text-[#3c8dbc]">Verwijder</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <x-add-client />
    </div>
  </main>
</body>

</html>