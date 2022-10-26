<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/client.php';
include_once '../objects/contactGegevens.php';
include_once '../objects/secretCodes.php';
include_once '../objects/mailer.php';
include_once '../objects/mails.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare contactGegevens object
$contactGegevens = new ContactGegevens($db);

// prepare client object
$client = new Client($db);

// get email adres
$email = $_POST['email']; //isset($_POST['email']) ? $_POST['email'] : ""

// read all contactGegevens
$stmt = $contactGegevens->read();
$num = $stmt->rowCount();

$emailExists = false;
if ($num > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['email'] == $email) {
            $client->contactGegevensId = $row['contactGegevensId'];
            $emailExists = true;
        }
    }
}

if ($emailExists) {
    // read all contactGegevens
    $stmt = $client->read_by_email();
    $num = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($num > 0) {
        // get naam/ namen van BEGELEIDER
        $clientvoornaam = $row['voornaam'];
        $clientachternaam = $row['achternaam'];

        // prepare secretCode object
        $secretCodes = new SecretCodes($db);
        $randomNumber = random_int(100000, 999999);
        $secretCodes->secretCode = password_hash($randomNumber, PASSWORD_DEFAULT);
        $secretCodes->createdAt = date('Y-m-d H:i:s');
        if ($secretCodes->create()) {
            // prepare mail-object
            $mail = new Mails($db);
            $mail->mailId = 4;
            $stmt = $mail->read_single();

            if ($stmt->rowCount() > 0) {
                $rowMail = $stmt->fetch(PDO::FETCH_ASSOC);

                $mailinhoud = $rowMail['inhoud'];
                $mailtitel = $rowMail['titel'];

                // prepare mailer object
                $mailer = new Mailer();
                $webAppLink = $mailer->link;

                // list of keywords to look for in the mail
                $keywords = ["[voornaam]", "[achternaam]", "[verifieerlink]", "[wachtwoordresetlink]", "[tevredenheidsmetinglink]"];
                // make pattern for searching through mail
                $pattern = implode("|", $keywords); // [naam]|[link]|...

                // check if keywords are in the mail
                if (preg_match('#\b(' . $pattern . ')\b#', $mailinhoud)) {
                    // [..-link] vervangen door bruikbare links
                    $wachtwoordresetlink = substr($webAppLink  . "/src/pages/account/wachtwoordResetApp.php?id=" . $row['clientId'] . "&code=" . $randomNumber, 8);

                    $mailinhoud = str_replace("[wachtwoordresetlink]", $wachtwoordresetlink, $mailinhoud);
                    $mailinhoud = str_replace("[voornaam]", $clientvoornaam, $mailinhoud);
                    $mailinhoud = str_replace("[achternaam]", $clientachternaam, $mailinhoud);
                }

                $mailer->receiver = $email;
                $mailer->subject = $mailtitel;
                $mailer->message = $mailinhoud;
                $mailer->altMessage = $_POST['linkTekst'] .  ": " . $webAppLink . "/src/pages/account/wachtwoordResetApp.php?id=" . $row['clientId'] . "&code=" . $randomNumber;

                $mailer->sentMail();

                $response_arr = array(
                    "status" => true,
                    "message" => "Email is verstuurd",
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
                "message" => "secret code aanmaken mislukt",
            );
        }
    } else {
        $response_arr = array(
            "status" => false,
            "message" => $client->contactGegevensId, //"Email bestaat niet"
        );
    }
} else {
    $response_arr = array(
        "status" => false,
        "message" => "Er bestaat geen account met dit email adres",
    );
}

print_r(json_encode($response_arr));
