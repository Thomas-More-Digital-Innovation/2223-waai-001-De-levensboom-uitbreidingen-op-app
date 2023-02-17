<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Nieuwtjes</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <x-list-title title="Nieuwtjes" function="addNew" />
          <table class="border-collapse border border-[#f4f4f4] table-auto">
            <thead>
              <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Gecreerd op</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($news as $new)
              <tr class="font-normal">
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $new->titel }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $new->gecreerdop }}</td>
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
    </div>
  </main>
</body>

</html>