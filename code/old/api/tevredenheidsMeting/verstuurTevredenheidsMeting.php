<?php

session_start();

if (isset($_SESSION["login"])) {
    if ($_SESSION["login"] == 1 && ($_SESSION["functie"] == "admin" || $_SESSION["functie"] == "afdelingHoofd")) {

        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/tevredenheidsMeting.php';
        include_once '../objects/mailer.php';
        include_once '../objects/mails.php';

        // get database connection
        $database = new Database();
        $db = $database->getConnection();

        // get email adres enzo
        $email = $_POST['email'];
        $clientId = $_POST['clientId'];
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];

        // prepare mailer object
        $mailer = new Mailer();

        // prepare tevredenheidsMeting object
        $tevredenheidsMeting = new TevredenheidsMeting($db);
        // read the details of tevredenheidsMeting 
        $stmt = $tevredenheidsMeting->read_first();

        if ($stmt->rowCount() > 0) {
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // prepare mail-object
            $mail = new Mails($db);
            $mail->mailId = 5;
            $stmtMail = $mail->read_single();
            if ($stmtMail->rowCount() > 0) {
                $rowMail = $stmtMail->fetch(PDO::FETCH_ASSOC);

                $mailinhoud = $rowMail['inhoud'];
                $mailtitel = $rowMail['titel'];

                // list of keywords to look for in the mail
                $keywords = ["[voornaam]", "[achternaam]", "[verifieerlink]", "[wachtwoordresetlink]", "[tevredenheidsmetinglink]"];
                // make pattern for searching through mail
                $pattern = implode("|", $keywords); // [naam]|[link]|...

                // check if keywords are in the mail
                if (preg_match('#\b(' . $pattern . ')\b#', $mailinhoud)) {
                    // [..-link] vervangen door bruikbare links
                    $tevredenheidsmetinglink = substr(str_replace('clientid', $clientId, $row['formLink']), 8);
                    $mailinhoud = str_replace("[tevredenheidsmetinglink]", $tevredenheidsmetinglink, $mailinhoud);
                    $mailinhoud = str_replace("[voornaam]", $voornaam, $mailinhoud);
                    $mailinhoud = str_replace("[achternaam]", $achternaam, $mailinhoud);
                }

                $mailer->receiver = $email;
                $mailer->subject = $mailtitel;
                $mailer->message = $mailinhoud;
                $mailer->altMessage = 'Beste ' . $voornaam . ', \n U wordt verzocht om onderstaande tevredenheidsmeting in te vullen over uw begeleiding bij De Waaiburg. \n Tevredenheids Meting:' . $newFormLink;

                $mailer->sentMail();

                $response_arr = array(
                    "status" => true,
                    "message" => "Mail is succesvol verstuurd",
                );
            } else {
                $response_arr = array(
                    "status" => false,
                    "message" => "Niets opgehaald"
                );
            }
        } else {
            $response_arr = array(
                "status" => false,
                "message" => "Tevredenheids meting link niet gevonden",
            );
        }
    } else {
        $response_arr = array(
            "status" => false,
            "message" => "Authenticatie mislukt"
        );
    }
} else {
    $response_arr = array(
        "status" => false,
        "message" => "Authenticatie mislukt"
    );
}

// make response json format
print_r(json_encode($response_arr));
