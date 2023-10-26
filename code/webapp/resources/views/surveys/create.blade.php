@extends('layout')
<title>Waaiburg - Tevredenheids Meting</title>

@section('content')
    <h1 class="text-2xl">Tevredenheids meting toevoegen</h1>
    <form action="{{ route('surveys.store') }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('POST')

        <x-errormessage />

        <x-form-input name="title" text="Titel" />
        <x-form-input name="url" text="Google forms url" />


        <div class="flex gap-5">
            <x-form-button text="Aanmaken" />
            <x-form-button text="Annuleren" link="surveys.index" />
        </div>
    </form>
@endsection
