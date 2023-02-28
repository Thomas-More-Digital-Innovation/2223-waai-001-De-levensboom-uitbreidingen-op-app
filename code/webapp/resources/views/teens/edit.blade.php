<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Jongeren</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="flex flex-row">
      <div class="m-5 bg-white rounded border flex w-full flex-col h-full">
        <div class="border-t-4 rounded border-[#3c8dbc]">
          <div class="m-3">
              <h1 class="text-2xl">Info segment bewerken</h1>
              <form action="{{ route('teens.update', $teen->id) }}" method="POST" class="flex flex-col mt-3">
                @csrf
                @method('PATCH')

                <x-errormessage />
      
                <x-form-input name="title" text="Titel" :value="$teen" />

                <div class="flex gap-5">
                  <x-form-button text="Wijzigen" />
                  <x-form-button text="Annuleren" link="teens.index" />
                </div>
              </form>
          </div>
        </div>
      </div>

      <div class="m-5 bg-white rounded border flex w-full flex-col h-full">
        <div class="border-t-4 rounded border-[#3c8dbc]">
          <div class="m-3">
            <div class="flex items-center justify-between my-3">
              <h1 class="text-2xl">Infoblokken</h1>
              <a href="{{ route('teenInfoContents.create',['info_id' => $teen->id]) }}"><iconify-icon icon="fa6-solid:plus" class="text-3xl text-[#3c8dbc] cursor-pointer"></iconify-icon></a>
          </div>
            <table class="border-collapse border border-[#f4f4f4] table-auto">
              <thead>
                <tr>
                  <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                  <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($infoContents as $infoContent)
                <tr class="font-normal">
                  <td class="border border-[#f4f4f4] py-2 px-6">{{ $infoContent->title }}</td>
                  <td class="border border-[#f4f4f4] py-2 px-6">
                    <form action="{{ route('teenInfoContents.destroy', $infoContent->id) }}" method="post">
                      @csrf
                      @method('delete')
  
                      <a href="{{ route('teenInfoContents.edit', $infoContent->id) }}" class="text-[#3c8dbc]">Bewerk</a>
                      <span>|</span>
  
                      <button type="submit" class="text-[#3c8dbc]">Verwijder</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>