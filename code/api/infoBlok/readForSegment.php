<?php

session_start();

// include database and object files
include_once '../config/database.php';
include_once '../objects/infoBlok.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare infoBlok object
$infoBlok = new InfoBlok($db);

// set infoSegmentId 
$infoBlok->infoSegmentId = isset($_GET['id']) ? $_GET['id'] : "";
 
// query infoBlok
$stmt = $infoBlok->readForSegment();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    // infoBlokken array
    $response_arr=array();
    $response_arr["infoBlok"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        if($isActief == true){

            if(isset($_SESSION["login"])){
                $infoBlok_item=array(
                    "infoBlokId" => $infoBlokId+0,
                    "titel" => $titel,
                    "blokFotoUrl" => $blokFotoUrl,
                    "infoSegmentId" => $infoSegmentId+0,
                    "volgordeNr" => $volgordeNr+0,
                    "createdAt" => $createdAt
                );
                array_push($response_arr["infoBlok"], $infoBlok_item);
            } elseif($inhoud != ""){
                $infoBlok_item=array(
                    "infoBlokId" => $infoBlokId+0,
                    "titel" => $titel,
                    "blokFotoUrl" => $blokFotoUrl,
                    "infoSegmentId" => $infoSegmentId+0,
                    "volgordeNr" => $volgordeNr+0,
                    "createdAt" => $createdAt
                );
                array_push($response_arr["infoBlok"], $infoBlok_item);
            }
        }
    }
 
    print_r(json_encode($response_arr["infoBlok"]));
}
else{
    $response_arr=array(
        "status" => false,
        "message" => "Geen info blokken gevonden voor dit info segment",
    );
    print_r(json_encode($response_arr));
}
?>