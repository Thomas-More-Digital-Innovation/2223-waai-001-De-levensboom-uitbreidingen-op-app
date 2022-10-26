<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/nieuwtjes.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare nieuwtjes object
$nieuwtjes = new Nieuwtjes($db);
// set ID property of nieuwtjes 
$nieuwtjes->nieuwtjesId = isset($_GET['id']) ? $_GET['id'] : "";
// read the details of nieuwtjes 
$stmt = $nieuwtjes->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['isActief'] == true){
        // create array
        $response_arr=array(
            "nieuwtjesId" => $row['nieuwtjesId']+0,
            "titel" => $row['titel'],
            "korteInhoud" => $row['korteInhoud'],
            "inhoud" => $row['inhoud']
        );
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Nieuwtje is niet meer actief",
        ); 
    }
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Nieuwtje bestaat niet",
    ); 
}

// make response json format
print_r(json_encode($response_arr));

?>