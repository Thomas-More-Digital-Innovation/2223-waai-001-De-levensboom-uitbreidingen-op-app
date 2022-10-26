<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/afdeling.php';

        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare afdeling object
        $afdeling = new Afdeling($db);
        
        // set afdeling property values
        $afdeling->afdelingId = $_POST['id'];
        
        // remove the afdeling
        if($afdeling->delete()){
            $response_arr=array(
                "status" => true,
                "message" => "Afdeling is verwijdert!"
            );
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Afdeling verwijderen is mislukt"
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