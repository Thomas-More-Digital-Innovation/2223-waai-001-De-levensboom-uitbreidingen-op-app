@extends('layout')
<title>Waaiburg - Afdelingen</title>
@section('content')
    <h1 class="text-2xl">Afdeling toevoegen</h1>
    <form action="{{ route('departments.store') }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('POST')

        <x-errormessage />

        <x-form-input name="name" text="Naam" />

        <x-contactgegevens />
        <x-form-input name="email" text="Email" required="false" />
        <div class="flex gap-5">
            <x-form-button text="Aanmaken" />
            <x-form-button text="Annuleren" link="departments.index" />
        </div>
    </form>
@endsection
