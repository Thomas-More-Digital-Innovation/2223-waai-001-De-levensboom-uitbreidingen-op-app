<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/client.php';

        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare client object
        $client = new Client($db);
        
        // set client property values
        $client->clientId = $_POST['id'];
        
        // remove the client
        if($client->delete()){
            $response_arr=array(
                "status" => true,
                "message" => "Client is verwijdert!"
            );
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Client verwijderen is mislukt"
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