<!doctype html>
<html lang="nl">

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
                    <x-list-title title="Tevredenheids Meting" name="" />
                    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="survey">
                        <thead>
                            <tr>
                                <th class="border border-[#f4f4f4] py-2 px-6 text-left">Google form link</th>
                                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surveys as $survey)
                                <tr class="font-normal">
                                    <td class="border border-[#f4f4f4] py-2 px-6 w-full">{{ $survey->url }}</td>
                                    <td class="border border-[#f4f4f4] py-2 px-6 w-full">
                                        <a href="{{ route('surveys.edit', $survey->id) }}"
                                            class="text-[#3c8dbc]">Bewerk</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=18"
            text="documentatie over tevredenheids meting" />
    </main>
</body>

</html>
