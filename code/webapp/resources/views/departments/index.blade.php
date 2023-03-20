<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Waaiburg - Afdelingen</title>
</head>

<body class="flex">
    <x-navbar />
    <main class="w-full bg-[#ecf0f5]">
        <x-topbar />
        <x-welcome />

        <div class="m-5 bg-white rounded border">
            <div class="border-t-4 rounded border-[#3c8dbc]">
                <div class="m-3">
                    <x-list-title title="Afdelingen lijst" name="departments.create" />
                    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="departmentCreate">
                        <thead>
                            <tr>
                                <th class="border border-[#f4f4f4] py-2 px-6">Naam</th>
                                <th class="border border-[#f4f4f4] py-2 px-6">Contactgegevens</th>
                                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr class="font-normal">
                                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/3">{{ $department->name }}</td>
                                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/3">
                                        {{ $department->street . ' ' . $department->houseNumber }} <br>
                                        {{ $department->city . ' ' . $department->zipcode }} <br>
                                        {{ $department->phoneNumber }} <br> {{ $department->email }} </td>
                                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">
                                        <form action="{{ route('departments.destroy', $department->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')

                                            <a href="{{ route('departments.edit', $department->id) }}"
                                                class="text-[#3c8dbc]">Bewerk</a>
                                            <span>|</span>

                                            <button type="submit" class="text-[#3c8dbc]"
                                                onclick="return confirm('Ben je zeker dat je deze afdeling wilt verwijderen?');">Verwijder</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=8" text="documentatie over afdelingen" />
    </main>
</body>

</html>
