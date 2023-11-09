@extends('layout')
<title>Waaiburg - Levensboom</title>
@section('content')
    <h1 class="text-2xl">Vraag Wijzigen</h1>
    <form action="{{ route('questions.update', ['tree_part_id' => $question->tree_part_id, 'question_list_id' => $question->question_list_id, $question->id]) }}" method="POST"
        class="flex flex-col mt-3">
        @csrf
        @method('PATCH')

        <x-errormessage />

        <x-form-input name="content" text="vraag" :value="$question"/>

        <div class="flex gap-5">
            <x-form-button text="Wijzigen" />
            <x-form-button text="Annuleren" link="questionLists.index" />
        </div>
    </form>
@endsection


