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
        
        // set infoSegment property values
        $infoSegment->infoSegmentId = $_POST['id'];
        
        // remove het infoSegment
        if($infoSegment->delete()){
            $response_arr=array(
                "status" => true,
                "message" => "Info segment is verwijdert!"
            );
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Info segment verwijderen is mislukt"
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