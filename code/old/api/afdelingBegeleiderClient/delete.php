<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/afdelingBegeleiderClient.php';

        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare afdelingBegeleiderClient object
        $afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);
        
        // set afdelingBegeleiderClient property values
        $afdelingBegeleiderClient->afdelingBegeleiderClientId = $_POST['id'];
        
        // remove the begeleider
        if($afdelingBegeleiderClient->delete()){
            $response_arr=array(
                "status" => true,
                "message" => "Afdeling voor deze begeleider is verwijdert!"
            );
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Afdeling voor begeleider verwijderen is mislukt"
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