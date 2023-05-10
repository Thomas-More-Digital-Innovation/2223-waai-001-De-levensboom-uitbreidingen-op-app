@extends('layout')
<title>Waaiburg - Nieuwtjes</title>

@section('content')
    <h1 class="text-2xl">Nieuwtje wijzigen</h1>
    <form action="{{ route('news.update', $news->id) }}" method="POST" class="flex flex-col mt-3">
        @csrf
        @method('PATCH')

        <x-errormessage />

        <x-form-input name="title" text="Titel" :value="$news" />
        <x-form-input name="shortContent" text="Korte inhoud" :value="$news" required=false />

        <label for="content" class="font-bold">Inhoud</label>
        <textarea class="ckeditor form-control" name="content" id="content"></textarea>

        <div class="flex gap-5">
            <x-form-button text="Wijzigen" />
            <x-form-button text="Annuleren" link="news.index" />
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var data = {!! json_encode($news->content) !!};
            CKEDITOR.instances.content.setData(data);
        }, false);
    </script>
@endsection
