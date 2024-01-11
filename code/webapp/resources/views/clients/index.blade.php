@extends('layout')
<title>Waaiburg - Clienten</title>
@section('content')
    <x-list-title title="Clienten lijst" name="clients.create" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="clientCreate">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6">ID</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Voornaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Achternaam</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Afdeling&lpar;en&rpar;</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Begeleider&lpar;s&rpar;</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Geboortedatum</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Contactgegevens</th>
                <th class="border border-[#f4f4f4] py-2 px-">Acties</th>
            </tr>
        </thead>

<tbody>
            @foreach ($clients as $client)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->id }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->firstname }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->surname }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 align-text-top text-left">
                        @php
                            $clientDepartments = $departmentLists->where('user_id', $client->id);

                            if ($clientDepartments->isEmpty()) {
                                echo "<p>Geen afdeling</p>";
                            } else {
                                foreach ($clientDepartments as $clientDepartment) {
                                    $department = $departments->firstWhere('id', $clientDepartment->department_id);
                                    if ($department) {
                                        echo "<p>{$department->name}</p>";
                                    }
                                }
                            }
                        @endphp
                    </td>
                    <td class="border border-[#f4f4f4] py-2 px-6">
                        @php
                            $clientUserLists = $userLists->where('client_id', $client->id);

                            if ($clientUserLists->isEmpty()) {
                                echo "<p>Geen begeleider</p>";
                            } else {
                                foreach ($clientUserLists as $clientUserList) {
                                    $mentor = $mentors->firstWhere('id', $clientUserList->mentor_id);
                                    if ($mentor) {
                                        echo "<p>-{$mentor->firstname} {$mentor->surname}</p>";
                                    }
                                }
                            }
                        @endphp
                    </td>
                    <td class="border border-[#f4f4f4] py-2 px-6">{{ $client->birthdate }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6">
                        {{ $client->street . ' ' . $client->houseNumber }} <br>
                        {{ $client->city . ' ' . $client->zipcode }} <br> {{ $client->phoneNumber }}
                        <br> {{ $client->email }}
                    </td>
                    <td class="border border-[#f4f4f4] py-2 px-6">
                        <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                            @csrf
                            @method('delete')

                            <a href="{{ route('clients.edit', $client->id) }}" class="text-wb-blue">Bewerk</a>
                            <span>|</span>

                            <button type="submit" class="text-wb-blue"
                                onclick="return confirm('Ben je zeker dat je deze client wilt verwijderen?');">Verwijder</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
</table>
@endsection
@section('documentation')
<x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=3" text="documentatie over clienten" />
@endsection
