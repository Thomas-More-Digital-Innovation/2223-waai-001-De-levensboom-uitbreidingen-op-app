<label for="{{ $name }}" class="font-bold">{{$text}}*</label>
@if ($value != null)
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" required {{$disabled}} placeholder="Enter {{ strtolower($text) }}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3" value="{{ $value->$name }}">
@else 
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" required {{$disabled}} placeholder="Enter {{ strtolower($text) }}" class="border border-[#d2d6de] px-4 py-2 outline-[#3c8dbc] mb-3 @error("{{ $name }}") is-invalid @enderror" value="{{old($name)}}">
@endif