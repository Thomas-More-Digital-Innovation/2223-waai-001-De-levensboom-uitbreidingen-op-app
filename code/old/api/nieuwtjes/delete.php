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
        $nieuwtjes->nieuwtjesId = $_POST['id'];
        
        // remove the nieuwtjes
        if($nieuwtjes->delete()){
            $response_arr=array(
                "status" => true,
                "message" => "Nieuwtje is verwijdert!"
            );
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Nieuwtje verwijderen is mislukt"
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