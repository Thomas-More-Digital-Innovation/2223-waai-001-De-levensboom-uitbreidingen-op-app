@extends('layout')
<title>Waaiburg - Mails</title>
@section('content')
    <h1 class="text-2xl">Mail wijzigen</h1>
    <form action="{{ route('mails.update', $mail->id) }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('PATCH')

        <x-errormessage />

        <x-form-input name="title" text="Onderwerp" :value="$mail" />

        <label for="content" class="font-bold">Inhoud*</label>
        <textarea class="ckeditor form-control" name="content" id="content"></textarea>

        <div class="flex gap-5">
            <x-form-button text="Wijzigen" />
            <x-form-button text="Annuleren" link="mails.index" />
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var data = {!! json_encode($mail->content) !!};
            CKEDITOR.instances.content.setData(data);
        }, false);
    </script>
@endsection
