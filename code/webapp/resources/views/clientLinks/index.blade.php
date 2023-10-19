@extends('layout')
<title>Waaiburg - Antwoorden</title>
@section('content')
    <h1 class=" text-2xl">Jouw Clienten</h1>
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="clientList">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Voornaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Achternaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->firstname }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->surname }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6">
                        <a href="{{ route('clientLinks.edit', $client->id) }}" class="text-wb-blue">Bekijk vragenlijst</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=6" text="documentatie over begeleiders" />
@endsection
