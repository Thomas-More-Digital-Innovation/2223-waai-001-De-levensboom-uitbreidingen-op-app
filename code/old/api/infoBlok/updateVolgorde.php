<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/infoBlok.php';
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare infoBlok object
        $infoBlok = new InfoBlok($db);
        
        $volgordeArray = isset($_POST['volgordeArray']) ? $_POST['volgordeArray'] : [];
        $error = false;

        foreach ($volgordeArray as $arrayItem) {
            // set infoBlok property values
            $infoBlok->infoBlokId = $arrayItem[0];
            $infoBlok->volgordeNr = $arrayItem[1];

            // update de infoBlok
            if($infoBlok->updateVolgordeNr()){
            }
            else{
                $error = true;
            }
        }

        // update de infoBlok
        if($error){
            $response_arr=array(
                "status" => false,
                "message" => "Info blokken volgorde bewerken mislukt!"
            );
        }
        else{
            $response_arr=array(
                "status" => true,
                "message" => "Info blokken volgorde bewerken succesvol!"
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