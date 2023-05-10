@extends('layout')
<title>Waaiburg - Mails</title>
@section('content')
    <x-list-title title="Mails" name="" />
    <table class="border-collapse border border-[#f4f4f4] w-full" aria-describedby="mails">
        <thead>
            <tr>
                <th class="border border-[#f4f4f4] py-2 px-6 text-left">Onderwerp</th>
                <th class="border border-[#f4f4f4] py-2 px-6">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mails as $mail)
                <tr class="font-normal">
                    <td class="border border-[#f4f4f4] py-2 px-6 w-full">{{ $mail->title }}</td>
                    <td class="border border-[#f4f4f4] py-2 px-6 w-full">
                        <a href="{{ route('mails.edit', $mail->id) }}" class="text-[#3c8dbc]">Bewerk</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('documentation')
    <x-documentation-link link="/De_Waaiburg_webapp_documentatie.pdf#page=15" text="documentatie over mails" />
@endsection
