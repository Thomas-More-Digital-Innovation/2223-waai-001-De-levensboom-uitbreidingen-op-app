@extends('layout')
<title>Waaiburg - Levensboom</title>
@section('content')
    <h1 class="text-2xl">Vraag Toevoegen</h1>
    <form action="{{ route('questions.store', ['tree_part_id' => $tree_part_id, 'question_list_id' => $question_list_id]) }}" method="POST"
        class="flex flex-col mt-3">
        @csrf
        @method('POST')

        <x-errormessage />

        <x-form-input name="content" text="Vraag" />

        <div class="flex gap-5">
            <x-form-button text="Aanmaken" />
            <x-form-button text="Annuleren" link="questionLists.index" />
        </div>
    </form>
@endsection
