@extends('layout')
<title>Waaiburg - Tevredenheids Meting</title>
@section('content')
    <h1 class="text-2xl">Tevredenheids meting wijzigen</h1>
    <form action="{{ route('surveys.update', $survey->id) }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('PATCH')

        <x-errormessage />

        <x-form-input name="url" text="Google form link" :value="$survey" />

        <div class="flex gap-5">
            <x-form-button text="Wijzigen" />
            <x-form-button text="Annuleren" link="surveys.index" />
        </div>
    </form>
@endsection
