@extends('layout')
<title>Waaiburg - Vragen lijst</title>

@section('content')
    <h1 class="text-2xl">Vragen lijst wijzigen</h1>
    <form action="{{ route('questionLists.update', $questionList->id) }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('PATCH')

        <x-errormessage />

        <x-form-input name="title" text="Titel" :value="$questionList" />

        <div class="flex gap-5">
            <x-form-button text="Wijzigen" />
            <x-form-button text="Annuleren" link="questionLists.index" />
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var data = {!! json_encode($questionList->title) !!};
            CKEDITOR.instances.content.setData(data);
        }, false);
    </script>
@endsection
