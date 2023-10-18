<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Waaiburg - Levensboom</title>
    <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"
        integrity="sha384-YfSzYL1sDylXi5TVFdhLEG6HcUdHjsjPeJ+6yUTybeVgczFkdEDx71I0UsKfDsRa" crossorigin="anonymous">
    </script>
</head>

<body class="flex">
    <x-navbar />
    <main class="w-full bg-white">
        <x-topbar />
        <x-welcome />

        <div class="flex flex-row">
            <div class="m-5 bg-white rounded border flex w-full flex-col h-full">
                <div class="border-t-4 rounded border-wb-blue">
                    <div class="m-3">
                        <h1 class="text-2xl">Vraag Wijzigen</h1>
                        <form action="{{ route('questions.update', ['tree_part_id' => $question->tree_part_id, 'question_list_id' => $question->question_list_id, $question->id]) }}" method="POST"
                            class="flex flex-col mt-3">
                            @csrf
                            @method('PATCH')

                            <x-errormessage />

                            <x-form-input name="content" text="vraag" :value="$question"/>

                            <div class="flex gap-5">
                                <x-form-button text="Wijzigen" />
                                <x-form-button text="Annuleren" link="questionLists.index" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
