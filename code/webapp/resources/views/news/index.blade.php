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
          <x-list-title title="Nieuwtjes" name="news.create" />
          <table class="border-collapse border border-[#f4f4f4] w-full">
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
                <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">{{ $new->title }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">{{ $new->gecreerdop }}</td>
                <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">
                  <form action="{{ route('news.destroy', $new->id) }}" method="post">
                    @csrf
                    @method('delete')

                    <a href="{{ route('news.edit', $new->id) }}" class="text-[#3c8dbc]">Bewerk</a>
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
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=13" text="documentatie over nieuwtjes" />
  </main>
</body>

</html>