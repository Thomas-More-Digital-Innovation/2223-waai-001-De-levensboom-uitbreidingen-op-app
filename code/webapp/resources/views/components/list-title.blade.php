<div class="flex items-center justify-between my-3">
    <h1 class="text-2xl">{{ $title }}</h1>
    @if ($name != '')
        <a href="{{ route($name) }}">
            <iconify-icon icon="fa6-solid:plus" class="text-3xl text-wb-blue cursor-pointer"></iconify-icon>
        </a>
    @endif
</div>
