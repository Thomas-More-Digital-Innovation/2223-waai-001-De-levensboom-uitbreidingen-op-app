@extends('layout')
    <title>Waaiburg - Jongeren</title>
@section('content')
    <x-list-title title="Info Segmenten voor jongeren" name="teens.create" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="teenCreate">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Info blokken</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teens as $teen)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left w-1/3">
                        {{ $teen->title }}</td>
                    <td
                        class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left list-decimal w-1/3">
                        <ul>
                            @foreach ($infoContents as $infoContent)
                                @if ($teen->id == $infoContent->info_id)
                                    <li>{{ $infoContent->title }}</li>
                                @endif
                            @endforeach
                        </ul>
                        @if ($teen->infoContents->count() == 0)
                            <p>Geen info blokken</p>
                        @endif
                    </td>
                    <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left w-1/4">
                        <form action="{{ route('teens.destroy', $teen->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('teens.edit', $teen->id) }}"
                                class="text-wb-blue">Bewerk</a>
                            <span>|</span>

                            <button type="submit" class="text-wb-blue"
                                onclick="return confirm('Ben je zeker dat je dit info segment wilt verwijderen?');">Verwijder</button>

                            <a href="{{ route('teens.updateOrder', ['teen' => $teen->id, 'order' => 'up']) }}"
                                class="up">
                                <iconify-icon icon="fa6-solid:angle-up" class=""></iconify-icon>
                            </a>
                            <a href="{{ route('teens.updateOrder', ['teen' => $teen->id, 'order' => 'down']) }}"
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
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=10" text="documentatie over info segmenten" />
@endsection
