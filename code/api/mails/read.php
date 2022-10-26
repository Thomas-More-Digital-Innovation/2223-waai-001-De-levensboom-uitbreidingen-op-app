<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/mails.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare mails object
$mails = new Mails($db);

// query mails
$stmt = $mails->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
    // mails array
    $response_arr=array();
    $response_arr["mails"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        if($isActief == true){
            $mails_item=array(
                "mailId" => $mailId+0,
                "titel" => $titel,
                "inhoud" => $inhoud,
                "createdAt" => $createdAt
            );
            array_push($response_arr["mails"], $mails_item);
        }
    }
    print_r(json_encode($response_arr["mails"]));
}
else{
    $response_arr=array(
        "status" => false,
        "message" => "Geen mails gevonden",
    );
    print_r(json_encode($response_arr));
}
?>