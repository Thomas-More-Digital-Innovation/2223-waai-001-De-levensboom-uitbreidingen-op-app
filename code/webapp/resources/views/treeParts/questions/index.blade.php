@extends('layout')
<title>Waaiburg - Vragen</title>

@section('content')
    <x-list-title title="Vragen" name="questions.create" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="questionsCreate">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Gecreerd op</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">{{ $question->title }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">{{ $question->created_at }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">
                        <form action="{{ route('questions.destroy', $question->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('questions.edit', $question->id) }}" class="text-wb-blue">Bewerk</a>
                            <span>|</span>

                            <button type="submit" class="text-wb-blue"
                                onclick="return confirm('Ben je zeker dat je deze vraag wilt verwijderen?');">Verwijder</button>
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
