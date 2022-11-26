<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/begeleider.php';
include_once '../objects/afdelingBegeleiderClient.php';
include_once '../objects/afdeling.php';
include_once '../objects/contactGegevens.php';


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
 
// query begeleider
$stmt = $begeleider->read();
$num = $stmt->rowCount();
// check if more than 0 record found

if($num>0){
    // begeleider array
    $response_arr=array();
    $response_arr["begeleider"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        if($isActief == true){
            // set ID property voor contactGegevens 
            $contactGegevens->contactGegevensId = $contactGegevensId;
            // read the details of contactgegevens 
            $stmtCG = $contactGegevens->read_single();
            // get retrieved row from contactgegevens
            $rowCG = $stmtCG->fetch(PDO::FETCH_ASSOC); 

            // set begeleiderId property voor afdelingBegeleiderClient 
            $afdelingBegeleiderClient->begeleiderId = $begeleiderId;
            // read the details of afdelingBegeleider 
            $stmtAB = $afdelingBegeleiderClient->readAfdelingenForBegeleider();

            // afdeling naam array
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
            

            $begeleider_item=array(
                "begeleiderId" => $begeleiderId+0,
                "afdelingen" => $afdelingen,
                "voornaam" => $voornaam,
                "achternaam" => $achternaam,
                "functie" => $functie,
                "straat" => $rowCG['straat'],
                "huisNr" => $rowCG['huisNr'],
                "woonplaats" => $rowCG['woonplaats'],
                "postcode" => $rowCG['postcode'],
                "telNummer" => $rowCG['telNummer'],
                "email" => $rowCG['email'],
                "createdAt" => $createdAt
            );
            array_push($response_arr["begeleider"], $begeleider_item);
        }
    }
    print_r(json_encode($response_arr["begeleider"]));
}
else{
    $response_arr=array(
        "status" => false,
        "message" => "Geen begeleiders gevonden"
    );
    print_r(json_encode($response_arr));
}
?>