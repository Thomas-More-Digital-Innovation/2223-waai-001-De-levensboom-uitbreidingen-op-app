<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("info_contents")->insert([
            "url" =>
                "https://docs.google.com/forms/d/e/1FAIpQLScCk4dRoV8IFlGi321m01g3YhVl6hvoxECf7HZrDmB8FDJI6g/viewform?usp=pp_url&entry.178942827=",
            "title" => "link",
            "info_id" => "1",
        ]);
        DB::table("info_contents")->insert([
            "title" => "Account verifiëren voor Waaiburg Web applicatie",
            "info_id" => "2",
            "content" => 'Beste,<br><br>
            Om uw account te activeren, vragen we u vriendelijk om de knop te gebruiken voor verificatie.<br><br>
            Mocht deze link niet meer geldig zijn, log dan opnieuw in en vraag eenvoudig een nieuwe verificatie link aan.',
        ]);
        DB::table("info_contents")->insert([
            "title" => "Account aangemaakt voor WebApp",
            "info_id" => "3",
            "content" => 'Welkom!<br>
            We hebben een account voor je aangemaakt.<br>
            Klik onderstaande knop om in te loggen met dit tijdelijk wachtwoord: "veranderMij"
            <br><br>
            Zodra je bent ingelogd, raden we je aan om je wachtwoord meteen te wijzigen voor de veiligheid van je account.
            <br><br>
            We kijken ernaar uit je op De Waaiburg WebApp te verwelkomen!',
        ]);
        DB::table("info_contents")->insert([
            "title" => "Account aangemaakt voor APP",
            "info_id" => "4",
            "content" => 'Welkom!<br>
            We hebben een account voor je aangemaakt.<br>
            Gebruik de onderstaande knop om in te loggen met het tijdelijke wachtwoord: "veranderMij"<br><br>
            Zodra je bent ingelogd, raden we je aan om onmiddellijk je wachtwoord te wijzigen in de webapplicatie om de veiligheid van je account te waarborgen.<br>
            Na het wijzigen van je wachtwoord kun je "De Waaiburg" app downloaden. Log daar in en begin aan je avontuur!<br><br>
            Link naar de App Store: https://apps.apple.com/be/app/de-waaiburg/id1592280272?l=nl <br>
            Link naar de Google Play Store: https://play.google.com/store/apps/details?id=com.dewaaiburg',
        ]);
        DB::table("info_contents")->insert([
            "title" => "Wachtwoord vergeten",
            "info_id" => "5",
            "content" => 'Beste,<br><br>
            Via onderstaande link kun je je wachtwoord opnieuw instellen. <br>
            Mocht deze link niet meer geldig zijn, klik dan op "wachtwoord vergeten" op de inlog-pagina en vraag eenvoudig een nieuwe verificatie link aan.',
        ]);
        DB::table("info_contents")->insert([
            "title" => "Tevredenheidsmeting beschikbaar",
            "info_id" => "6",
            "content" => 'Beste, <br><br>U wordt verzocht om onderstaande tevredenheidsmeting in te vullen over uw begeleiding bij De Waaiburg.<br><br>
            Het invullen van de vragenlijst duurt slechts 3 minuten. Je zou er ons mee helpen om te laten hoe je de begeleiding ervaren hebt.',
        ]);
    }
}
