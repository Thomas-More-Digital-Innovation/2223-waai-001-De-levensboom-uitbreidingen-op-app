@extends('layout')
    <title>Waaiburg - Jongeren</title>
@section("content")
    <h1 class="text-2xl">InfoContent wijzigen</h1>
    <form action="{{ route('teenInfoContents.update', $infoContent->id) }}" method="POST"
        class="flex flex-col mt-3">
        @csrf
        @method('PATCH')

        <x-errormessage />

        <x-form-input name="title" text="Titel" :value="$infoContent" />

        <x-blok-foto-link url="{{ $infoContent->titleImage }}" />

        <x-form-input name="url" text="Meer info link" :value="$infoContent" required="false" />

        <label for="text" class="font-bold">Inhoud</label>
        <textarea class="ckeditor form-control" name="content" id="content"></textarea>

        <div class="flex gap-5">
            <x-form-button text="Wijzigen" />
            <x-form-button text="Annuleren" link="teens.index" />
        </div>
    </form>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var data = {!! json_encode($infoContent->content) !!};
        CKEDITOR.instances.content.setData(data);
    }, false);
</script>
@endsection
