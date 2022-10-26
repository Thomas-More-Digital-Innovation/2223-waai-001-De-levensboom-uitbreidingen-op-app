<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/mails.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare mails object
$mails = new Mails($db);
// set ID property of mails 
$mails->mailId = isset($_GET['id']) ? $_GET['id'] : "";
// read the details of mails 
$stmt = $mails->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['isActief'] == true){
        // create array
        $response_arr=array(
            "mailId" => $row['mailId']+0,
            "titel" => $row['titel'],
            "inhoud" => $row['inhoud']
        );
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Mail is niet meer actief",
        ); 
    }
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Mail bestaat niet",
    ); 
}

// make response json format
print_r(json_encode($response_arr));

?>