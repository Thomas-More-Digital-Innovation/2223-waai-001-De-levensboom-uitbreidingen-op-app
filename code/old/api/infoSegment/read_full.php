<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/infoSegment.php';
include_once '../objects/infoBlok.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare infoSegment object
$infoSegment = new InfoSegment($db);

// prepare infoBlok object
$infoBlok = new InfoBlok($db);

// Check wich read query to use 
$read = isset($_GET['read']) ? $_GET['read'] : "";

$error = false;
if($read == "all"){
    // query infoSegment
    $stmt = $infoSegment->read();
} elseif($read == "jongeren"){
    // query infoSegment
    $stmt = $infoSegment->readJongeren();
} elseif($read == "volwassenen"){
    // query infoSegment
    $stmt = $infoSegment->readVolwassenen();
} else {
    $error = true;
}
 
if($error == false) {
    $num = $stmt->rowCount();
    // check if more than 0 record found
    if($num>0){
        // afdelingen array
        $response_arr=array();
        $response_arr["infoSegment"]=array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            // set ID property of infoBlok 
            $infoBlok->infoSegmentId = $infoSegmentId;

            // read the details of infoBlok 
            $stmtBk = $infoBlok->readForSegment();
            $activeBlokCount = 0;
            while ($rowBK = $stmtBk->fetch(PDO::FETCH_ASSOC)){
                if($rowBK['isActief'] == true){
                    $activeBlokCount +=1;   
                }
            }

            if($activeBlokCount > 0){
                if($isActief == true){
                    $infoSegment_item=array(
                        "infoSegmentId" => $infoSegmentId+0,
                        "titel" => $titel,
                        "isVolwassenen" => $isVolwassenen+0,
                        "volgordeNr" => $volgordeNr+0,
                        "createdAt" => $createdAt
                    );
                    array_push($response_arr["infoSegment"], $infoSegment_item);
                }
            }
        }
        print_r(json_encode($response_arr["infoSegment"]));
    }
    else{
        $response_arr=array(
            "status" => false,
            "message" => "Geen infoSegmenten gevonden",
        );
        print_r(json_encode($response_arr));
    }
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Foutieve request 'read' waarde",
    );
    print_r(json_encode($response_arr));
}

?>