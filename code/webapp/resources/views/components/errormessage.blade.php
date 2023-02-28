@if ($errors->any())
<div class="">
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-red-500 py3">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif