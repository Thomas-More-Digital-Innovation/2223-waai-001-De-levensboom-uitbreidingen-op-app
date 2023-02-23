<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Volwassenen</title>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
            <h1 class="text-2xl">info blok toevoegen</h1>
            <form action="{{ route('adultInfoContents.store') }}" method="POST" class="flex flex-col mt-3">
                @csrf
                @method('POST')
    
                <x-form-input name="title" text="Titel" />

                <label for="titleImage" class="font-bold">Blok Foto</label>
                <p>Geef een url in van een foto die online staat, of upload een foto van je op pc.</p>
                <input type="text" name="titleImage" id="titleImage" placeholder="Enter blok foto url"  class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">
                <input type="text" name="titleImage" id="titleImage"  class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">

                <x-form-input name="url" text="Meer info link" />

                <label for="text" class="font-bold">Inhoud*</label>
                <textarea class="ckeditor form-control" name="wysiwyg-editor"></textarea>

                 <x-form-button text="Aanmaken" />
            </form>
        </div>
      </div>
    </div>
  </main>
</body>
<script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
      $('.ckeditor').ckeditor();
  });
</script>
</html>