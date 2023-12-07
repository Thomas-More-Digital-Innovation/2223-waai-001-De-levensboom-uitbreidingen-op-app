@extends('layout')
<title>Waaiburg - Nieuwtjes</title>

@section('content')
    <x-list-title title="Nieuwtjes" name="news.create" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="newsCreate">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Titel</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Gecreerd op</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $new)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/2">{{ $new->title }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">{{ $new->created_at }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-1/4">
                        <form action="{{ route('news.destroy', $new->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('news.edit', $new->id) }}" class="text-wb-blue">Bewerk</a>
                            <span>|</span>

                            <button type="submit" class="text-wb-blue"
                                onclick="return confirm('Ben je zeker dat je dit nieuwtje wilt verwijderen?');">Verwijder</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=14" text="documentatie over nieuwtjes" />
@endsection
