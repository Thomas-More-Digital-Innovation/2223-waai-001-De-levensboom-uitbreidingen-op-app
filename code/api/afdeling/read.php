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

// prepare contactGegevens object
$contactGegevens = new ContactGegevens($db);
 
// query afdelingen
$stmt = $afdeling->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
    // afdelingen array
    $response_arr=array();
    $response_arr["afdeling"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        if($isActief == true){
            // set ID property of contactGegevens 
            $contactGegevens->contactGegevensId = $contactGegevensId;

            // read the details of contactgegevens 
            $stmtCG = $contactGegevens->read_single();

            // get retrieved row from contactgegevens
            $rowCG = $stmtCG->fetch(PDO::FETCH_ASSOC);
                
            $afdeling_item=array(
                "afdelingId" => $afdelingId+0,
                "naam" => $naam,
                "straat" => $rowCG['straat'],
                "huisNr" => $rowCG['huisNr'],
                "woonplaats" => $rowCG['woonplaats'],
                "postcode" => $rowCG['postcode'],
                "telNummer" => $rowCG['telNummer'],
                "email" => $rowCG['email'],
                "createdAt" => $createdAt
            );
            array_push($response_arr["afdeling"], $afdeling_item);
        }
    }
    print_r(json_encode($response_arr["afdeling"]));
}
else{
    $response_arr=array(
        "status"=> false,
        "message"=> "Geen afdelingen gevonden"
    );
    print_r(json_encode(response_arr));
}
?>