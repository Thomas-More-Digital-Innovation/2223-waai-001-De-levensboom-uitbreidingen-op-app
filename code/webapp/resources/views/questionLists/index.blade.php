@extends('layout')
<title>Waaiburg - Vragenlijsten</title>

@section('content')
    <x-list-title title="Vragenlijsten" name="questionLists.create" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="QuestionListCreate">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Gecreerd op</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questionLists as $questionList)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">{{ $questionList->title }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">{{ $questionList->created_at }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">
                        <form action="{{ route('questionLists.destroy', $questionList->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('questionLists.edit', $questionList->id) }}" class="text-wb-blue">Bewerk</a>
                            <span>|</span>

                            <button type="submit" class="text-wb-blue"
                                onclick="return confirm('Ben je zeker dat je deze vragenlijst wilt verwijderen? Alle vragen en antwoorden onder deze vragenlijst zullen ook verwijdert worden');">Verwijder</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=13" text="documentatie over nieuwtjes" />
@endsection
