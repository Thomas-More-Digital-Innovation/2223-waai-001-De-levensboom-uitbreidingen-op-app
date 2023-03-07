<x-mail::message>
{!! $infoContent->content !!}
<x-mail::button :url="$url">
    {{$actionText}}
</x-mail::button>
@lang('Met vriendelijke groeten'),<br>
{{ config('app.name') }}



<x-slot:subcopy>
@lang(
    "Als je problemen hebt met het klikken op de knop \":actionText\", kopieer en plak dan de URL hieronder\n".
    'in uw webbrowser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">{{ $url }}</span>
</x-slot:subcopy>
</x-mail::message>