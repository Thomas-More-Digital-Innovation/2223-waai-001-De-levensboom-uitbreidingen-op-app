@extends('layout')
<title>Waaiburg - Tevredenheids Meting</title>
@section('content')
    <x-list-title title="Tevredenheids Meting" name="surveys.create" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="survey">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6 text-left">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Google form link</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surveys as $survey)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/6">{{ $survey->title }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-2/3 break-all">{{ $survey->url }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/6">
                        <form action="{{ route('surveys.destroy', $survey->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('surveys.edit', $survey->id) }}" class="text-wb-blue">Bewerk</a>
                            <span>|</span>

                            <button type="submit" class="text-wb-blue"
                                onclick="return confirm('Ben je zeker dat je deze tevredenheidsmeting wilt verwijderen?');">Verwijder</button>
                        </form>
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
