@if ($type == 'checkbox')
    <div class="flex gap-5 items-center mb-3">
        <label for="{{ $name }}"
            class="font-bold">{{ $text }}{{ $required === 'true' ? '*' : '' }}</label>
        @if ($value != null)
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
                {{ $required === 'true' ? 'required' : null }} {{ $disabled }}
                placeholder="Enter {{ strtolower($text) }}"
                class="border border-[#d2d6de] px-4 py-2 outline-wb-blue @error("{{ $name }}") is-invalid @enderror"
                {{ $value->user_type_id==1 ? 'checked': '' }}>
        @else
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
                {{ $required === 'true' ? 'required' : null }} {{ $disabled }}
                placeholder="Enter {{ strtolower($text) }}"
                class="border border-[#d2d6de] px-4 py-2 outline-wb-blue @error("{{ $name }}") is-invalid @enderror">
        @endif
    </div>
@else
    <label for="{{ $name }}"
        class="font-bold">{{ $text }}{{ $required === 'true' ? '*' : '' }}</label>
    @if ($value != null)
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            {{ $required === 'true' ? 'required' : null }} {{ $disabled }}
            placeholder="Enter {{ strtolower($text) }}"
            class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3 @error("{{ $name }}") is-invalid @enderror"
            value="{{ $value->$name }}">
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            {{ $required === 'true' ? 'required' : null }} {{ $disabled }}
            placeholder="Enter {{ strtolower($text) }}"
            class="border border-[#d2d6de] px-4 py-2 outline-wb-blue mb-3 @error("{{ $name }}") is-invalid @enderror"
            value="{{ old($name) }}">
    @endif
@endif
