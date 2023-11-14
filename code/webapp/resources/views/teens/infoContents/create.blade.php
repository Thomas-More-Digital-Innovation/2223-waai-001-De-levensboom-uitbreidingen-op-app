@extends('layout')
    <title>Waaiburg - Jongeren</title>
@section('content')
    <h1 class="text-2xl">Info blok toevoegen</h1>
    <form action="{{ route('teenInfoContents.store', ['info_id' => $info_id]) }}" method="POST"
        class="flex flex-col mt-3">
        @csrf
        @method('POST')
        <x-errormessage />
        <x-form-input name="title" text="Titel" />
        <x-blok-foto-link url="" />
        <x-form-input name="url" text="Meer info link" required="false" />
        <label for="text" class="font-bold">Inhoud</label>
        <textarea class="ckeditor form-control" name="content"></textarea>
        <div class="flex gap-5">
            <x-form-button text="Aanmaken" />
            <x-form-button text="Annuleren" link="teens.index" />
        </div>
    </form>
@endsection
