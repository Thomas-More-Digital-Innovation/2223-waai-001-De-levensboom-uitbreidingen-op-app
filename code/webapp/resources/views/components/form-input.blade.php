<label for="{{ $name }}" class="font-bold">{{ $text }}{{ $required === 'true' ? '*' : '' }}</label>
@if ($value != null)
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        {{ $required === 'true' ? 'required' : null }} {{ $disabled }} placeholder="Enter {{ strtolower($text) }}"
        class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3 @error("{{ $name }}") is-invalid @enderror"
        value="{{ $value->$name }}">
@else
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        {{ $required === 'true' ? 'required' : null }} {{ $disabled }}
        placeholder="Enter {{ strtolower($text) }}"
        class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3 @error("{{ $name }}") is-invalid @enderror"
        value="{{ old($name) }}">
@endif
