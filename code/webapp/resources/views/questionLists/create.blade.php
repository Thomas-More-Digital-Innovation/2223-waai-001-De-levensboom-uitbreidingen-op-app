@extends('layout')
<title>Waaiburg - Vragen lijst</title>

@section('content')
    <h1 class="text-2xl">Vragen lijst toevoegen</h1>
    <form action="{{ route('questionLists.store') }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('POST')

        <x-errormessage />

        <x-form-input name="title" text="Titel" />

        <div class="flex gap-5">
            <x-form-button text="Aanmaken" />
            <x-form-button text="Annuleren" link="questionLists.index" />
        </div>
    </form>
@endsection
