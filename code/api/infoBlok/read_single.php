<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/infoBlok.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare infoBlok object
$infoBlok = new InfoBlok($db);

// set ID property of infoBlok 
$infoBlok->infoBlokId = isset($_GET['id']) ? $_GET['id'] : "";

// read the details of infoBlok 
$stmt = $infoBlok->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['isActief'] == true){
         // create array
        $response_arr=array(
            "infoBlokId" => $row['infoBlokId']+0,
            "titel" => $row['titel'],
            "inhoud" => $row['inhoud'],
            "blokFotoUrl" => $row['blokFotoUrl'],
            "meerInfoLink" => $row['meerInfoLink'],
            "infoSegmentId" => $row['infoSegmentId']+0,
            "volgordeNr" => $row['volgordeNr']+0,
        );
        

    } else {
        $response_arr=array(
            "status" => false,
            "message" => "InfoBlok is niet meer actief",
        ); 
    }
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Info bestaat niet",
    );  
}

// make response json format
print_r(json_encode($response_arr));

?>