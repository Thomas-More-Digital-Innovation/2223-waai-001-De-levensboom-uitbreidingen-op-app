@extends('layout')
<title>Waaiburg - Levensboom</title>

@section('content')
    <x-list-title title="Levensboom" name="treeParts.create" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="treePartsCreate">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Gecreerd op</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($treeParts as $treePart)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">{{ $treePart->title }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">{{ $treePart->created_at }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">
                        <form action="{{ route('treeParts.destroy', $treePart->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('treeParts.edit', $treePart->id) }}" class="text-wb-blue">Bewerk</a>
                            <span>|</span>

                            <button type="submit" class="text-wb-blue"
                                onclick="return confirm('Ben je zeker dat je Dit deel van de boom wilt verwijderen?');">Verwijder</button>
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
