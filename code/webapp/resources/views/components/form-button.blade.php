@if ($link == true)
    <a href="{{ route($link) }}" class="bg-gray-500 rounded px-4 py-1 mt-5 text-white">{{ $text }}</a>
@else
    <button type="submit" class="bg-[#3c8dbc] rounded px-4 py-1 mt-5 text-white">{{ $text }}</button>
@endif
