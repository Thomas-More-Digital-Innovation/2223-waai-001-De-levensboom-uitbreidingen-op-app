<?php

// Uncomment voor error reporting aan te zetten  (debugging)
// error_reporting(-1);
// ini_set('display_errors', 'On');

use Firebase\JWT\JWT;
use Dotenv\Dotenv;

require_once('../../vendor/autoload.php');

// include database and object files
include_once '../config/database.php';
include_once '../objects/client.php';
include_once '../objects/contactGegevens.php';
include_once '../objects/afdelingBegeleiderClient.php';
include_once '../objects/afdeling.php';


// De bearer(jwt) token ophalen 
if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    $response_arr=array(
        "status" => false,
        "message" => "Token not found in request",
    );
} 

//jwt token vallideren 
$validToken = false;
$jwt = isset($matches[1]) ? $matches[1] : null;  
if($jwt) {
    // Env variabelen ophalen
    $currentDir = __DIR__;
    $apiPos = strpos($currentDir,"api");
    $rootDir = substr($currentDir, 0, $apiPos);
    $dotenv = Dotenv::createImmutable($rootDir);
    $dotenv->load();

    //decoderen van token
    $token = JWT::decode($jwt, $_ENV["JWT_SECRET_KEY"],['HS512']);

    //Checken of token valide is 
    $now = new DateTimeImmutable();
    if($token->iss == $_ENV['WEBAPP_LINK'] && $token->nbf < $now->getTimestamp()) {
        $validToken = true;
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Token is niet valide",
        );
    }
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Token not found in request",
    );
}



if($validToken) {

    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // prepare client object
    $client = new Client($db);

    // prepare afdelingBegeleiderClient object
    $afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

    // prepare afdeling object
    $afdeling = new Afdeling($db);

    // prepare contactGegevens object
    $contactGegevens = new ContactGegevens($db);

    // set ID property of client 
    $client->clientId =  $token->clientId;

    // read the details of client 
    $stmt = $client->read_single();

    if($stmt->rowCount() > 0){
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['isActief'] == true){

            // set ID property of contactGegevens 
            $contactGegevens->contactGegevensId = $row['contactGegevensId'];
            // read the details of contactgegevens 
            $stmtCG = $contactGegevens->read_single();
            // get retrieved row from contactgegevens
            $rowCG = $stmtCG->fetch(PDO::FETCH_ASSOC);

            // set clientId property voor afdelingBegeleiderClient 
            $afdelingBegeleiderClient->clientId = $client->clientId;
            // read the details of afdelingBegeleiderClient 
            $stmtAB = $afdelingBegeleiderClient->readAfdelingenForClient();

            // afdelingen array
            $afdelingen=array();
            while ($rowAB = $stmtAB->fetch(PDO::FETCH_ASSOC)){

                // set ID property voor afdeling 
                $afdeling->afdelingId = $rowAB["afdelingId"];
                // read the details of afdeling 
                $stmtA = $afdeling->read_single();
                // get retrieved row from afdeling
                $rowA = $stmtA->fetch(PDO::FETCH_ASSOC);

                // voeg afdeling naam toe aan array
                array_push($afdelingen, $rowA["naam"]);  
            }

            // geboortedatum formateren naar juiste format
            $geboorteDatumFormated = new DateTime($row['geboorteDatum']);
            $geboorteDatumFormated = $geboorteDatumFormated->format('d-m-Y'); 

            // create array
            $response_arr=array(
                "status" => true,
                "voornaam" => $row['voornaam'],
                "achternaam" => $row['achternaam'],
                "afdelingen" => $afdelingen,
                "geboorteDatum" => $geboorteDatumFormated,
                "straat" => $rowCG['straat'],
                "huisNr" => $rowCG['huisNr'],
                "woonplaats" => $rowCG['woonplaats'],
                "postcode" => $rowCG['postcode'],
                "telNummer" => $rowCG['telNummer'],
                "email" => $rowCG['email'],
            );

        } else {
            $response_arr=array(
                "status" => false,
                "message" => "Client is niet meer actief",
            );
        }
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Client bestaat niet",
        );
    }
}

if(!$response_arr["status"]) {
    header('HTTP/1.0 400 Bad Request');
}

// make response json format
print_r(json_encode($response_arr));

?>