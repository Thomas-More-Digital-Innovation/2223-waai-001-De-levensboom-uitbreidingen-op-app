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

        // set infoBlok property values
        $infoBlok->titel = $_POST['titel'];
        $infoBlok->inhoud = $_POST['inhoud'];
        $infoBlok->blokFotoUrl = $_POST['blokFotoUrl'];
        $infoBlok->meerInfoLink = $_POST['meerInfoLink'];
        $infoBlok->infoSegmentId = $_POST['infoSegmentId'];
        $infoBlok->volgordeNr = 0;

        // create een infoBlok
        if($infoBlok->create()){
            $response_arr=array(
                "status" => true,
                "message" => "Info blok succesvol toevoegd!",
            );
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Info blok aanmaken mislukt!"
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