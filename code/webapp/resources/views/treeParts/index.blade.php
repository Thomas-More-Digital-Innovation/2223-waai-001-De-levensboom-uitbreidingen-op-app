@extends('layout')
<title>Waaiburg - Levensboom</title>

@section('content')
<h1 class="text-2xl">De Levensboom</h1>
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="treePartsCreate">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($treeParts as $treePart)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">{{ $treePart->tree_part }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">
                    <a href="{{ route('treeParts.edit', $treePart->id) }}" class="text-wb-blue">Bewerk</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=13" text="documentatie over nieuwtjes" />
@endsection
