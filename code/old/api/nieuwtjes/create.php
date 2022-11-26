<?php


session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/nieuwtjes.php';

        // get database connection
        $database = new Database();
        $db = $database->getConnection();

        // prepare nieuwtjes object
        $nieuwtjes = new Nieuwtjes($db);

        // set nieuwtjes property values
        $nieuwtjes->titel = $_POST['titel'];
        $nieuwtjes->korteInhoud = $_POST['korteInhoud'];
        $nieuwtjes->inhoud = $_POST['inhoud'];

        // create the nieuwtjes
        if($nieuwtjes->create()){
            $response_arr=array(
                "status" => true,
                "message" => "Nieuwtje succesvol toegevoegd!"
            );
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Nieuwtje aanmaken mislukt!"
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