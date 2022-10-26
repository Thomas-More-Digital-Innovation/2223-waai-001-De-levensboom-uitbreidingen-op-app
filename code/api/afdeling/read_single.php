<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/afdeling.php';
include_once '../objects/contactGegevens.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare afdeling object
$afdeling = new Afdeling($db);
// set ID property of afdeling 
$afdeling->afdelingId = isset($_GET['id']) ? $_GET['id'] : die();
// read the details of afdeling 
$stmt = $afdeling->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['isActief'] == true){
        // prepare contactGegevens object
        $contactGegevens = new ContactGegevens($db);
        // set ID property of contactGegevens 
        $contactGegevens->contactGegevensId = $row['contactGegevensId'];
        // read the details of contactgegevens 
        $stmtCG = $contactGegevens->read_single();
        // get retrieved row from contactgegevens
        $rowCG = $stmtCG->fetch(PDO::FETCH_ASSOC);

        // create array
        $response_arr=array(
            "status" => true,
            "afdelingId" => $row['afdelingId']+0,
            "naam" => $row['naam'],
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
            "message" => "Deze afdeling is niet actief"
        );
    }

} else {
    $response_arr=array(
        "status" => false,
        "message" => "Deze afdeling bestaat niet"
    );
}

// make response into json format
print_r(json_encode($response_arr));

?>