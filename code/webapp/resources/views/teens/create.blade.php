<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Waaiburg - Jongeren</title>
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
                        <h1 class="text-2xl">Info segment toevoegen</h1>
                        <form action="{{ route('teens.store') }}" method="POST" class="flex flex-col mt-3">
                            @csrf
                            @method('POST')

                            <x-errormessage />

                            <x-form-input name="title" text="Titel" />

                            <div class="flex gap-5">
                                <x-form-button text="Toevoegen" />
                                <x-form-button text="Annuleren" link="teens.index" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="m-5 bg-white rounded border flex w-full flex-col h-full">
                <div class="border-t-4 rounded border-wb-blue">
                    <div class="m-3">
                        <h1 class="text-2xl">Infoblokken</h1>
                        <p class="mt-3 text-gray-800">Voeg de info blokken toe op de update pagina</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
