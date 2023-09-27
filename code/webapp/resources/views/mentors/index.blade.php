@extends('layout')
<title>Waaiburg - Begeleiders</title>
@section('content')
    <x-list-title title="Begeleiders lijst" name="mentors.create" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="mentorCreate">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">Voornaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Achternaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Functie</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Contactgegevens</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mentors as $mentor)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6">{{ $mentor->firstname }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6">{{ $mentor->surname }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left">
                        <p>{{ $mentor->user_type }}
                        <p>
                            @foreach ($departmentLists as $departmentList)
                                @foreach ($departments as $department)
                                    @if ($departmentList->department_id == $department->id && $departmentList->user_id == $mentor->id)
                                        <p>- {{ $department->name }}</p>
                                    @endif
                                @endforeach
                            @endforeach
                    </td>
                    <td class="border border-[#f4f4f4] py-2 px-6">
                        {{ $mentor->street . ' ' . $mentor->houseNumber }} <br>
                        {{ $mentor->city . ' ' . $mentor->zipcode }} <br> {{ $mentor->phoneNumber }}
                        <br> {{ $mentor->email }}
                    </td>
                    <td class="border border-[#f4f4f4] py-2 px-6">
                        <form action="{{ route('mentors.destroy', $mentor->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('mentors.edit', $mentor->id) }}" class="text-wb-blue">Bewerk</a>
                            <span>|</span>

                            <button type="submit" class="text-wb-blue"
                                onclick="return confirm('Ben je zeker dat je deze begeleider wilt verwijderen?');">Verwijder</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=6" text="documentatie over begeleiders" />
@endsection
