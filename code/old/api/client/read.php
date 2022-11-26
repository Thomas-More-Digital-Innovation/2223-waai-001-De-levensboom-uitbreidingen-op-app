<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/client.php';
include_once '../objects/afdeling.php';
include_once '../objects/begeleider.php';
include_once '../objects/contactGegevens.php';
include_once '../objects/afdelingBegeleiderClient.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare client object
$client = new Client($db);

// prepare afdeling object
$afdeling = new Afdeling($db);

// prepare afdeling object
$begeleider = new Begeleider($db);

// prepare afdelingBegeleiderClient object
$afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

// prepare contactGegevens object
$contactGegevens = new ContactGegevens($db);
 
// query client
$stmt = $client->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
    // client array
    $response_arr=array();
    $response_arr["client"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        if($isActief == true) {

            // set ID property voor contactGegevens 
            $contactGegevens->contactGegevensId = $contactGegevensId;
            // read the details of contactgegevens 
            $stmtCG = $contactGegevens->read_single();
            // get retrieved row from contactgegevens
            $rowCG = $stmtCG->fetch(PDO::FETCH_ASSOC);

            // set begeleiderId property voor afdelingBegeleiderClient 
            $afdelingBegeleiderClient->clientId = $clientId;
            // read the details of afdelingBegeleider 
            $stmtAB = $afdelingBegeleiderClient->readAfdelingenForClient();
            // read the details of begeleiderClient
            $stmtBC = $afdelingBegeleiderClient->readBegeleidersForClient();

            // afdelingen naam array
            $afdelingen=array();
            while ($rowAB = $stmtAB->fetch(PDO::FETCH_ASSOC)){

                // set ID property voor afdeling 
                $afdeling->afdelingId = $rowAB["afdelingId"];
                // read the details of afdeling 
                $stmtA = $afdeling->read_single();
                // get retrieved row from afdeling
                $rowA = $stmtA->fetch(PDO::FETCH_ASSOC);
                // voeg afdeling toe aan array
                array_push($afdelingen, $rowA);   
            }

            // begeleider naam array
            $begeleiders=array();
            while ($rowBC = $stmtBC->fetch(PDO::FETCH_ASSOC)){

                // set ID property voor begeleider 
                $begeleider->begeleiderId = $rowBC["begeleiderId"];
                // read the details of begeleider 
                $stmtB = $begeleider->read_single();
                // get retrieved row from begeleider
                $rowB = $stmtB->fetch(PDO::FETCH_ASSOC);
                // voeg begeleider toe aan array
                array_push($begeleiders, $rowB);   
            }

            // geboortedatum formateren naar juiste format
            $geboorteDatumFormated = new DateTime($geboorteDatum);
            $geboorteDatumFormated = $geboorteDatumFormated->format('d-m-Y');   

            $client_item=array(
                "clientId" => $clientId+0,
                "afdelingen" => $afdelingen,
                "begeleiders" => $begeleiders,
                "voornaam" => $voornaam,
                "achternaam" => $achternaam,
                "geslacht" => $geslacht,
                "geboorteDatum" => $geboorteDatumFormated,
                "straat" => $rowCG['straat'],
                "huisNr" => $rowCG['huisNr'],
                "woonplaats" => $rowCG['woonplaats'],
                "postcode" => $rowCG['postcode'],
                "telNummer" => $rowCG['telNummer'],
                "email" => $rowCG['email'],
                "createdAt" => $createdAt
            );
            array_push($response_arr["client"], $client_item);
        }
    }
    print_r(json_encode($response_arr["client"]));
} else{
    $response_arr=array(
        "status" => false,
        "message" => "Geen clienten gevonden"
    );
    print_r(json_encode($response_arr));
}

?>