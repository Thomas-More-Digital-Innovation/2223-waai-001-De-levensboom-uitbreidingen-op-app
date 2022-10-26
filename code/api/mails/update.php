<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/mails.php';
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare mails object
        $mails = new Mails($db);
        
        // set mails property values
        $mails->mailId = $_POST['mailId'];
        $mails->titel = $_POST["titel"];
        $mails->inhoud = $_POST["inhoud"];

        // update het mail
        if($mails->update()){
            $response_arr=array(
                "status" => true,
                "message" => "Mail succesvol geupdate!"
            );
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Mail bewerken mislukt!"
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