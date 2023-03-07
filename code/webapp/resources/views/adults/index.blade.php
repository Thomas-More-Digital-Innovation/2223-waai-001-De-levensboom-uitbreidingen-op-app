<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Volwassenen</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
          <x-list-title title="Info Segmenten voor volwassenen" name="adults.create" />
          <table class="border-collapse border border-[#f4f4f4] w-full">
            <thead>
              <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Info blokken</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
              </tr>
            </thead>
            <tbody class="drag-sort-enable">
              @foreach ($adults as $adult)

              <tr class="font-normal">
                <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left w-1/3">{{ $adult->title }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left list-decimal w-1/3">

                    @foreach ($infoContents as $infoContent)
                      @if ($adult->id == $infoContent->info_id)
                        <li>{{ $infoContent->title }}</li>
                      @endif
                    @endforeach
                    @if ($adult->infoContents->count() == 0)
                      <p>Geen info blokken</p>
                    @endif
                </td>
                <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left w-1/4">
                  <form action="{{ route('adults.destroy', $adult->id) }}" method="post">
                    @csrf
                    @method('delete')

                    <a href="{{ route('adults.edit', $adult->id) }}" class="text-[#3c8dbc]">Bewerk</a>
                    <span>|</span>

                    <button type="submit" class="text-[#3c8dbc]">Verwijder</button>

                    <a href="{{ route('adults.updateOrder', ['adult' => $adult->id, 'order' => 'up']) }}" class="up"><iconify-icon icon="fa6-solid:angle-up" class=""></iconify-icon></a>
                    <a href="{{ route('adults.updateOrder', ['adult' => $adult->id, 'order' => 'down']) }}" class="down"><iconify-icon icon="fa6-solid:angle-down" class=""></iconify-icon></a>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=10" text="documentatie over info segmenten" />
  </main>
</body>
</html>