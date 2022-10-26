<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/infoSegment.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare infoSegment object
$infoSegment = new InfoSegment($db);
// set ID property of infoSegment 
$infoSegment->infoSegmentId = isset($_GET['id']) ? $_GET['id'] : "";
// read the details of infoSegment 
$stmt = $infoSegment->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    if($row['isActief'] == true){
        // create array
        $response_arr=array(
            "titel" => $row['titel'],
            "isVolwassenen" => $row['isVolwassenen']+0,
            "volgordeNr" => $row['volgordeNr']+0
        );
        
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "InfoSegment is niet meer actief"
        );  
    }
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Geen infoSegment gevonden"
    ); 
}

// make it json format
print_r(json_encode($response_arr));

?>