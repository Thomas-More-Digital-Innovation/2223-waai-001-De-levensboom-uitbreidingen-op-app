@extends('layout')
<title>Waaiburg - Nieuwtjes</title>

@section('content')
    <h1 class="text-2xl">Nieuwtje toevoegen</h1>
    <form action="{{ route('news.store') }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('POST')

        <x-errormessage />

        <x-form-input name="title" text="Titel" />
        <x-form-input name="shortContent" text="Korte inhoud" required=false />

        <label for="content" class="font-bold">Inhoud</label>
        <textarea class="ckeditor form-control" name="content" id="content"></textarea>

        <div class="flex gap-5">
            <x-form-button text="Aanmaken" />
            <x-form-button text="Annuleren" link="news.index" />
        </div>
    </form>
@endsection
