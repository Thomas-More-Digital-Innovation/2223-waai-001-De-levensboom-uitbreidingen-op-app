<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/nieuwtjes.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare nieuwtjes object
$nieuwtjes = new Nieuwtjes($db);

// query nieuwtjes
$stmt = $nieuwtjes->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
    // nieuwtjes array
    $response_arr=array();
    $response_arr["nieuwtjes"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        if($isActief == true){
            $nieuwtjes_item=array(
                "nieuwtjesId" => $nieuwtjesId+0,
                "titel" => $titel,
                "korteInhoud" => $korteInhoud,
                "inhoud" => $inhoud,
                "createdAt" => $createdAt
            );
            array_push($response_arr["nieuwtjes"], $nieuwtjes_item);
        }
    }
    print_r(json_encode($response_arr["nieuwtjes"]));
}
else{
    $response_arr=array(
        "status" => false,
        "message" => "Geen nieuwtjes gevonden",
    );
    print_r(json_encode($response_arr));
}
?>