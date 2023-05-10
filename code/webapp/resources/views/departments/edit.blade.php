@extends('layout')
<title>Waaiburg - Afdelingen</title>
@section('content')
    <h1 class="text-2xl">Afdeling wijzigen</h1>
    <form action="{{ route('departments.update', $department->id) }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('PATCH')

        <x-errormessage />

        <x-form-input name="name" text="Naam" :value="$department" />

        <x-contactgegevens :contactgegevens="$department" />
        <x-form-input name="email" text="Email" :value="$department" />
        <div class="flex gap-5">
            <x-form-button text="Bewerk" />
            <x-form-button text="Annuleren" link="departments.index" />
        </div>
    </form>
@endsection
