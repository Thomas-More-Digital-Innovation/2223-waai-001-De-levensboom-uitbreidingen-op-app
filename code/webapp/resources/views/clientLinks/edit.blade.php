@extends('layout')
<title>Waaiburg - Antwoorden</title>
@section('content')
    <h1 class=" text-2xl">Vragenlijsten - Beantwoord</h1>
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="clientList">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Vragenlijst</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($question_lists as $question_list)
                @if ($question_user_lists->pluck('question_list_id')->contains($question_list->id))
                    <tr class="font-normal">
                        <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">{{ $question_list->title }}</td>
                        <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">
                            <a href="{{ route('clientAnswers.index', ['question_list_id' => $question_list->id, 'client_id' => $client_id]) }}" class="text-wb-blue">Bekijk antwoorden</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <h1 class=" text-2xl pt-5">Vragenlijsten - Onbeantwoord</h1>
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="clientList">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Vragenlijst</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($question_lists as $question_list)
                @unless ($question_user_lists->pluck('question_list_id')->contains($question_list->id))
                    <tr class="font-normal">
                        <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">{{ $question_list->title }}</td>
                        <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">
                            <a href="{{ route('clientLinks.edit', $client_id) }}" class="text-wb-blue">Bekijk antwoorden</a>
                        </td>
                    </tr>
                @endunless
            @endforeach
        </tbody>
    </table>
@endsection

@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=6" text="documentatie over begeleiders" />
@endsection

@section('script')
<script>

</script>
@endsection