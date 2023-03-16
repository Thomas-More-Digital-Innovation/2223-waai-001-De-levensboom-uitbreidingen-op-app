<!doctype html>
<html lang="nl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Mails</title>
  <script src="//cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
</head>

<body class="flex">
  <x-navbar />
  <main class="w-full bg-[#ecf0f5]">
    <x-topbar />
    <x-welcome />

    <div class="m-5 bg-white rounded border">
      <div class="border-t-4 rounded border-[#3c8dbc]">
        <div class="m-3">
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
        </div>
      </div>
    </div>
  </main>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function(){ 
    var data = {!! json_encode($mail->content) !!};
    CKEDITOR.instances.content.setData(data);
  }, false);
</script>

</html>