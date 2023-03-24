<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Waaiburg - Volwassenen</title>
    <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"
        integrity="sha384-YfSzYL1sDylXi5TVFdhLEG6HcUdHjsjPeJ+6yUTybeVgczFkdEDx71I0UsKfDsRa" crossorigin="anonymous">
    </script>
</head>

<body class="flex">
    <x-navbar />
    <main class="w-full bg-[#ecf0f5]">
        <x-topbar />
        <x-welcome />

        <div class="m-5 bg-white rounded border">
            <div class="border-t-4 rounded border-[#3c8dbc]">
                <div class="m-3">
                    <h1 class="text-2xl">Info blok toevoegen</h1>
                    <form action="{{ route('adultInfoContents.store', ['info_id' => $info_id]) }}" method="POST"
                        class="flex flex-col mt-3" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <x-errormessage />

                        <x-form-input name="title" text="Titel" />
                        
                        <x-blok-foto-link />

                        <label for="url" class="font-bold">Meer info link</label>
                        <input type="text" name="url" id="url" placeholder="Enter meer info link"
                            class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">


                        <label for="content" class="font-bold">Inhoud</label>
                        <textarea class="ckeditor form-control" name="content" id="content"></textarea>

                        <div class="flex gap-5">
                            <x-form-button text="Aanmaken" />
                            <x-form-button text="Annuleren" link="adults.index" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
