<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Jongeren</title>
  <script src="//cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

      <div class="flex flex-row">
        <div class="m-5 bg-white rounded border flex w-full flex-col h-full">
          <div class="border-t-4 rounded border-[#3c8dbc]">
            <div class="m-3">
                <h1 class="text-2xl">Info blok toevoegen</h1>
                <form action="{{ route('teenInfoContents.store', ['info_id' => $info_id]) }}" method="POST" class="flex flex-col mt-3">
                  @csrf
                  @method('POST')

                  <x-errormessage />
      
                  <x-form-input name="title" text="Titel" />
  
                  <label for="titleImage" class="font-bold">Blok Foto</label>
                  <p>Geef een url in van een foto die online staat, of upload een foto van je op pc.</p>
                  <input type="text" name="titleImage" id="titleImage" placeholder="Enter blok foto url"  class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">
                  <input type="file" name="titleImage" id="titleImage"  class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">
  
                  <label for="url" class="font-bold">Meer info link</label>
                  <input type="text" name="url" id="url" placeholder="Enter meer info link" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3">
  
                  <label for="text" class="font-bold">Inhoud*</label>
                  <textarea class="ckeditor form-control" name="content"></textarea>
                  
                  <div class="flex gap-5">
                    <x-form-button text="Aanmaken" />
                    <x-form-button text="Annuleren" link="teens.index" />
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </main>
</body>
</html>