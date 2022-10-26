<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/infoSegment.php';
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare infoSegment object
        $infoSegment = new InfoSegment($db);
        
        $volgordeArray = isset($_POST['volgordeArray']) ? $_POST['volgordeArray'] : [];
        $error = false;

        foreach ($volgordeArray as $arrayItem) {
            // set infoSegment property values
            $infoSegment->infoSegmentId = $arrayItem[0];
            $infoSegment->volgordeNr = $arrayItem[1];

            // update de infoSegment volgorde
            if($infoSegment->updateVolgordeNr()){}
            else{
                $error = true;
            }
        }
        // update de infoSegment
        if($error){
            $response_arr=array(
                "status" => false,
                "message" => "Info segmenten volgorde bewerken mislukt!"
            );
        }
        else{
            $response_arr=array(
                "status" => true,
                "message" => "Info segmenten volgorde bewerken succesvol!"
            );

        }
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Authenticatie mislukt"
        );
    }  
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Authenticatie mislukt"
    );
}  
print_r(json_encode($response_arr));

?>