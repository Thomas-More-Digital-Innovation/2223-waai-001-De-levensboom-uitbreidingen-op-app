<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>Waaiburg - Mails</title>
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
                
                <x-form-input name="subject" text="Onderwerp" :value="$mail" />

                <label for="text" class="font-bold">Inhoud*</label>
                <textarea class="ckeditor form-control" name="wysiwyg-editor"></textarea>

                <x-form-button text="Wijzigen" />
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