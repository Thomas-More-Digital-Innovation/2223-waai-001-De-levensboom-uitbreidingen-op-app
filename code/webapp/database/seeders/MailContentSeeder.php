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
        DB::table('info_contents')->insert(['url' => 'https://docs.google.com/forms/d/e/1FAIpQLScCk4dRoV8IFlGi321m01g3YhVl6hvoxECf7HZrDmB8FDJI6g/viewform?usp=pp_url&entry.178942827=', 'title' => 'link', 'info_id' => '1']);
        DB::table('info_contents')->insert(['title' => 'Account aangemaakt voor Waaiburg Web applicatie', 'info_id' => '2', 'content' => 'Beste, <br><br>Er is een account aangemaakt voor de webapp van De Waaiburg. Via onderstaande link kan u uw account verifiëren. <br><br>Is deze link verlopen, ga dan naar de inlog pagina, vul je email adres in, en klik op wachtwoord vergeten.']);
        DB::table('info_contents')->insert(['title' => 'Account aangemaakt voor APP', 'info_id' => '3', 'content' => 'Beste, <br><br>Er is een Waaiburg account aangemaakt voor u.<br><br>Download de Waaiburg app via de App Store op iOS of via de Play Store op Android, ga naar de inlog pagina, vul je e-mailadres in en klik op "Wachtwoord vergeten?".<br><br>Wil je meteen je account verifieren? Dat kan via onderstaande link:']);
        DB::table('info_contents')->insert(['title' => 'Wachtwoord vergeten voor WebApp', 'info_id' => '4', 'content' => 'Beste, <br><br>Via onderstaande link kun je je wachtwoord opnieuw instellen. Is de link verlopen of ongeldig, ga dan naar de inlog-pagina, vul je e-mailadres in en klik op "Wachtwoord vergeten?".']);
        DB::table('info_contents')->insert(['title' => 'Wachtwoord vergeten voor APP', 'info_id' => '5', 'content' => 'Beste, <br><br>Via onderstaande link kun je je wachtwoord opnieuw instellen. Is de link verlopen of ongeldig, ga dan naar de inlog-pagina, vul je e-mailadres in en klik op "Wachtwoord vergeten?".']);
        DB::table('info_contents')->insert(['title' => 'Tevredenheidsmeting beschikbaar', 'info_id' => '6', 'content' => 'Beste, <br><br>U wordt verzocht om onderstaande tevredenheidsmeting in te vullen over uw begeleiding bij De Waaiburg.<br><br>Het invullen van de vragenlijst duurt slechts 3 minuten. Je zou er ons mee helpen om te laten hoe je de begeleiding ervaren hebt.']);
    }
}
