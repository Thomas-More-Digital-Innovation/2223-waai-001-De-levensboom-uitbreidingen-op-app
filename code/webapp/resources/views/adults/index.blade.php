@extends('layout')
    <title>Waaiburg - Volwassenen</title>
@section('content')
    <x-list-title title="Info Segmenten voor volwassenen" name="adults.create" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="adultCreate">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Info blokken</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody class="drag-sort-enable">
            @foreach ($adults as $adult)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left w-1/3">
                        {{ $adult->title }}</td>
                    <td
                        class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left list-decimal w-1/3">
                        <ul>
                            @foreach ($infoContents as $infoContent)
                                @if ($adult->id == $infoContent->info_id)
                                    <li>{{ $infoContent->title }}</li>
                                @endif
                            @endforeach
                        </ul>
                        @if ($adult->infoContents->count() == 0)
                            <p>Geen info blokken</p>
                        @endif
                    </td>
                    <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left w-1/4">
                        <form action="{{ route('adults.destroy', $adult->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('adults.edit', $adult->id) }}"
                                class="text-wb-blue">Bewerk</a>
                            <span>|</span>

                            <button type="submit" class="text-wb-blue"
                                onclick="return confirm('Ben je zeker dat je dit info segment wilt verwijderen?');">Verwijder</button>

                            <a href="{{ route('adults.updateOrder', ['adult' => $adult->id, 'order' => 'up']) }}"
                                class="up">
                                <iconify-icon icon="fa6-solid:angle-up" class=""></iconify-icon>
                            </a>
                            <a href="{{ route('adults.updateOrder', ['adult' => $adult->id, 'order' => 'down']) }}"
                                class="down">
                                <iconify-icon icon="fa6-solid:angle-down" class=""></iconify-icon>
                            </a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=11" text="documentatie over info segmenten" />
@endsection
