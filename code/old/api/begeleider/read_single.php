<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/begeleider.php';
include_once '../objects/contactGegevens.php';
include_once '../objects/afdelingBegeleiderClient.php';
include_once '../objects/afdeling.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare begeleider object
$begeleider = new Begeleider($db);

// prepare afdelingBegeleiderClient object
$afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

// prepare afdeling object
$afdeling = new Afdeling($db);

// prepare contactGegevens object
$contactGegevens = new ContactGegevens($db);

// set ID property of begeleider 
$begeleider->begeleiderId = isset($_GET['id']) ? $_GET['id'] : "";

// read the details of begeleider 
$stmt = $begeleider->read_single();


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

        // set begeleiderId property voor afdelingBegeleiderClient 
        $afdelingBegeleiderClient->begeleiderId = $begeleider->begeleiderId;
        // read the details of afdelingBegeleiderClient 
        $stmtAB = $afdelingBegeleiderClient->readAfdelingenForBegeleider();

        // afdelingen array
        $afdelingen=array();
        $afdelingBegeleiderId_arr=array();
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
            array_push($afdelingBegeleiderId_arr, $rowAB["afdelingBegeleiderClientId"]);
        }

        // create array
        $response_arr=array(
            "begeleiderId" => $row['begeleiderId']+0,
            "afdelingen" => $afdelingen,
            "afdelingBegeleiderIds" => $afdelingBegeleiderId_arr,
            "voornaam" => $row['voornaam'],
            "achternaam" => $row['achternaam'],
            "functie" => $row['functie'],
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
            "message" => "Deze begeleider is niet meer actief"
        );
    }
    
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Begeleider niet gevonden"
    );
}

// make response json format
print_r(json_encode($response_arr));


?>