<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Waaiburg - Levensboom</title>
</head>

<body class="flex">
    <x-navbar />
    <main class="w-full bg-white">
        <x-topbar />
        <x-welcome />

        <div class="flex flex-row">
            <div class="m-5 bg-white rounded border flex w-1/2 flex-col h-full">
                <div class="border-t-4 rounded border-wb-blue">
                    <div class="m-3">
                        <h1 class="text-2xl">Tree part bewerken</h1>
                        <form action="{{ route('treeParts.update', [$treePart->id, 'question_list_id' =>$questionList->id]) }}" method="POST" class="flex flex-col mt-3">
                            @csrf
                            @method('PATCH')

                            <x-errormessage />

                            <x-form-input name="name" text="Naam" :value="$treePart" />

                            <div class="flex gap-5">
                                <x-form-button text="Wijzigen" />
                                <x-form-button text="Annuleren" link="questionLists.index" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-1/2">
                <div class="m-5 bg-white rounded border flex flex-col h-full">
                    <div class="border-t-4 rounded border-wb-blue">
                        <div class="m-3">
                            <div class="flex items-center justify-between my-3">
                                <h1 class="text-2xl">Vragen</h1>
                                <a href="{{ route('questions.create', ['question_list_id' => $questionList->id, 'tree_part_id' => $treePart->id]) }}">
                                    <iconify-icon icon="fa6-solid:plus" class="text-3xl text-wb-blue cursor-pointer">
                                    </iconify-icon>
                                </a>
                            </div>
                            <table class="border-collapse border border-[#f4f4f4] w-full"
                                aria-describedby="questions">
                                <thead>
                                    <tr>
                                        <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                                        <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                        <tr class="font-normal">
                                            <td class="border border-[#f4f4f4] py-2 px-6">{{ $question->content }}</td>
                                            <td class="border border-[#f4f4f4] py-2 px-6">
                                                <form action="{{ route('questions.destroy', $question->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a href="{{ route('questions.edit', $question->id) }}"
                                                        class="text-wb-blue">Bewerk</a>
                                                    <span>|</span>

                                                    <button type="submit" class="text-wb-blue"
                                                        onclick="return confirm('Ben je zeker dat je deze vraag wilt verwijderen?');">Verwijder</button>
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
