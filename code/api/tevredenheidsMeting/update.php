<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/tevredenheidsMeting.php';
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare tevredenheidsMeting object
        $tevredenheidsMeting = new TevredenheidsMeting($db);
        
        // set tevredenheidsMeting property values
        $tevredenheidsMeting->tevredenheidsMetingId = $_POST['tevredenheidsMetingId'];
        $tevredenheidsMeting->formLink = $_POST['formLink'];

        // update de tevredenheidsMeting
        if($tevredenheidsMeting->update()){
            $response_arr=array(
                "status" => true,
                "message" => "tevredenheidsMeting succesvol geupdate!"
            );
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "tevredenheidsMeting bewerken mislukt!"
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