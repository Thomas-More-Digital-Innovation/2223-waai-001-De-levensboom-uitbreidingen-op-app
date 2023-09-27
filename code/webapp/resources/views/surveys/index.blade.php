@extends('layout')
<title>Waaiburg - Tevredenheids Meting</title>
@section('content')
    <x-list-title title="Tevredenheids Meting" name="" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="survey">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6 text-left">Google form link</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surveys as $survey)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 w-full">{{ $survey->url }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-full">
                        <a href="{{ route('surveys.edit', $survey->id) }}" class="text-wb-blue">Bewerk</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=18"
        text="documentatie over tevredenheids meting" />
@endsection
