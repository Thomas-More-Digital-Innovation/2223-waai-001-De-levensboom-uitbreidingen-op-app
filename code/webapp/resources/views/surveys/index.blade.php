<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Tevredenheids Meting</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <x-list-title title="Tevredenheids Meting" function="addSurvey" />
          <table class="border-collapse border border-[#f4f4f4] table-auto">
            <thead>
              <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Google form link</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($surveys as $survey)
              <tr class="font-normal">
                <td class="border border-[#f4f4f4] py-2 px-6">{{ $survey->formlink }}</td>
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
      <x-add-survey />
    </div>
  </main>
</body>

</html>