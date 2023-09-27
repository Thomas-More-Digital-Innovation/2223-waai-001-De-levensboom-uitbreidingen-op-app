<div class="bg-wb-yellow m-5 p-4 pr-5 text-white rounded">
    <h2 class="font-semibold mb-2 text-lg">Tip!</h2>
    @if ($text == '')
        <p>Is er ergens iets niet duidelijk? Bekijk de <a href="{{ $link }}" rel="noopener" target="_blank"
                class="underline">documentatie</a> als hulpmiddel!</p>
    @else
        <p>Bekijk de <a href="{{ $link }}" rel="noopener" target="_blank" class="underline">{{ $text }}</a>
            voor meer info!</p>
    @endif
</div>
