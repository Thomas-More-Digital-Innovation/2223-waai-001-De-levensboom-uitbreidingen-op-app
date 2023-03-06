<x-mail::message>
{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
<h1>
    test
</h1>
@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{ $actionText }}
</x-mail::button>
@endisset


@lang('Met vriendelijke groeten'),<br>
{{ config('app.name') }}



<x-slot:subcopy>
@lang(
    "Als je problemen hebt met het klikken op de knop \":actionText\", kopieer en plak dan de URL hieronder\n".
    'in uw webbrowser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
</x-mail::message>
