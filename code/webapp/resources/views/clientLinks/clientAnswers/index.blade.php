@extends('layout')
<title>Waaiburg - Antwoorden</title>
@section('style')
    <style>
        .rotate-transition {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
    </style>
@endsection
@section('content')
    <h1 class="text-2xl">Antwoorden van {{ $client->firstname }} {{ $client->surname }}</h1>
    <div>
        @foreach($tree_parts as $tree_part)
        <h2>
            <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200" onclick="toggleTestDiv({{ $tree_part->id }})">
                <span>{{ $tree_part->name }}</span>
                <svg id="svg-{{ $tree_part->id }}" data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div class="hidden" id="test-{{ $tree_part->id }}">
            <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="answerList">
                <thead>
                    <tr>
                        <th class="border border-[#f4f4f4] py-2 px-6">Vraag</th>
                        <th class="border border-[#f4f4f4] py-2 px-6">Antwoord</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        @if ($question->tree_part_id == $tree_part->id)
                            <tr class="font-normal">
                                <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">{{ $question->content }}</td>
                                @php
                                    $answer = $answers->firstWhere('question_id', $question->id);
                                @endphp
                                <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">
                                    @if ($answer)
                                        {{ $answer->answer }}
                                    @else
                                        Deze vraag is nog niet beantwoord
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
    <div class="mt-10">
        <a href="{{ route('clientLinks.edit', $client->id)}}"  class="rounded bg-wb-blue px-5 py-2 text-white font-bold">Vorige pagina</a>
    </div>
@endsection
@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=6" text="documentatie over Antwoorden" />
@endsection
@section('scripts')
    <script>
        function toggleTestDiv(treePartId) {
            const testDiv = document.getElementById(`test-${treePartId}`);
            const svgIcon = document.getElementById(`svg-${treePartId}`);
            
            if (testDiv && svgIcon) {
                testDiv.classList.toggle('hidden');
                svgIcon.classList.toggle('rotate-transition');
            }
        }
    </script>
@endsection
