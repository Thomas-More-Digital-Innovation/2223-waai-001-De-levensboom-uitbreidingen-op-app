<!doctype html>
<html lang="nl">

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

        <div class="flex flex-row">
            <div class="m-5 bg-white rounded border flex w-1/2 flex-col h-full">
                <div class="border-t-4 rounded border-[#3c8dbc]">
                    <div class="m-3">
                        <h1 class="text-2xl">Info segment bewerken</h1>
                        <form action="{{ route('adults.update', $adult->id) }}" method="POST"
                            class="flex flex-col mt-3">
                            @csrf
                            @method('PATCH')

                            <x-errormessage />

                            <x-form-input name="title" text="Titel" :value="$adult" />

                            <div class="flex gap-5">
                                <x-form-button text="Wijzigen" />
                                <x-form-button text="Annuleren" link="adults.index" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-1/2">
                <div class="m-5 bg-white rounded border flex flex-col h-full">
                    <div class="border-t-4 rounded border-[#3c8dbc]">
                        <div class="m-3">
                            <div class="flex items-center justify-between my-3">
                                <h1 class="text-2xl">Infoblokken</h1>
                                <a href="{{ route('adultInfoContents.create', ['info_id' => $adult->id]) }}">
                                    <iconify-icon icon="fa6-solid:plus" class="text-3xl text-[#3c8dbc] cursor-pointer">
                                    </iconify-icon>
                                </a>
                            </div>
                            <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="adultEdit">
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
                                                <form
                                                    action="{{ route('adultInfoContents.destroy', $infoContent->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a href="{{ route('adultInfoContents.edit', $infoContent->id) }}"
                                                        class="text-[#3c8dbc]">Bewerk</a>
                                                    <span>|</span>

                                                    <button type="submit" class="text-[#3c8dbc]"
                                                        onclick="return confirm('Ben je zeker dat je dit info segment wilt verwijderen?');">Verwijder</button>

                                                    <a href="{{ route('adultInfoContents.updateOrder', ['adult' => $adult->id, 'info_id' => $infoContent->id, 'order' => 'up']) }}"
                                                        class="up">
                                                        <iconify-icon icon="fa6-solid:angle-up" class="">
                                                        </iconify-icon>
                                                    </a>
                                                    <a href="{{ route('adultInfoContents.updateOrder', ['adult' => $adult->id, 'info_id' => $infoContent->id, 'order' => 'down']) }}"
                                                        class="down">
                                                        <iconify-icon icon="fa6-solid:angle-down" class="">
                                                        </iconify-icon>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=11"
                    text="documentatie over info blokken" />
            </div>
        </div>
    </main>
</body>

</html>
