<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/client.php';
include_once '../objects/contactGegevens.php';
include_once '../objects/afdelingBegeleiderClient.php';
include_once '../objects/afdeling.php';
include_once '../objects/begeleider.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare client object
$client = new Client($db);

// prepare afdelingBegeleiderClient object
$afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

// prepare afdeling object
$afdeling = new Afdeling($db);

// prepare afdeling object
$begeleider = new Begeleider($db);

// prepare contactGegevens object
$contactGegevens = new ContactGegevens($db);

// set ID property of client 
$client->clientId = isset($_GET['id']) ? $_GET['id'] : "";

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
        // read the details of afdelingBegeleiderClient 
        $stmtBC = $afdelingBegeleiderClient->readBegeleidersForClient();

        // afdelingen array
        $afdelingen=array();
        $afdelingClientId_arr=array();
        while ($rowAB = $stmtAB->fetch(PDO::FETCH_ASSOC)){

            // set ID property voor afdeling 
            $afdeling->afdelingId = $rowAB["afdelingId"];
            // read the details of afdeling 
            $stmtA = $afdeling->read_single();
            // get retrieved row from afdeling
            $rowA = $stmtA->fetch(PDO::FETCH_ASSOC);

            // voeg afdeling toe aan array
            array_push($afdelingen, $rowA);  
            
            //voeg afdelingBegeleiderId toe aan array
            array_push($afdelingClientId_arr, $rowAB["afdelingBegeleiderClientId"]);
        }

        // begeleiders array
        $begeleiders=array();
        $begeleiderClientId_arr=array();
        while ($rowBC = $stmtBC->fetch(PDO::FETCH_ASSOC)){

            // set ID property voor begeleider
            $begeleider->begeleiderId = $rowBC["begeleiderId"];
            // read the details of begeleider 
            $stmtB = $begeleider->read_single();
            // get retrieved row from begeleider
            $rowB = $stmtB->fetch(PDO::FETCH_ASSOC);

            // voeg begeleider toe aan array
            array_push($begeleiders, $rowB);  
            
            //voeg begeleiderClientId_arr toe aan array
            array_push($begeleiderClientId_arr, $rowBC["afdelingBegeleiderClientId"]);
        }

        // geboortedatum formateren naar juiste format
        $geboorteDatumFormated = new DateTime($row['geboorteDatum']);
        $geboorteDatumFormated = $geboorteDatumFormated->format('d-m-Y'); 

        // create array
        $response_arr=array(
            "clientId" => $row['clientId']+0,
            "afdelingen" => $afdelingen,
            "afdelingClientIds" => $afdelingClientId_arr,
            "begeleiders" => $begeleiders,
            "begeleiderClientIds" => $begeleiderClientId_arr,
            "voornaam" => $row['voornaam'],
            "achternaam" => $row['achternaam'],
            "geslacht" => $row['geslacht'],
            "geboorteDatum" => $geboorteDatumFormated,
            "straat" => $rowCG['straat'],
            "huisNr" => $rowCG['huisNr'],
            "woonplaats" => $rowCG['woonplaats'],
            "postcode" => $rowCG['postcode'],
            "telNummer" => $rowCG['telNummer'],
            "email" => $rowCG['email'],
            "tevredenheidsMetingVerstuurd" => $row['tevredenheidsMetingVerstuurd']
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

// make response json format
print_r(json_encode($response_arr));

?>