<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../objects/cloudinary.php';
        
        // prepare infoBlok object
        $cloudinary = new Cloudinary();

        $cloudinary->imageFile = $_FILES['upload']['tmp_name'];
        $cloudinary->public_id = 'waaiburgWebApp/' . $_FILES['upload']['name'];

        $response = $cloudinary->upload(); //$cloudinary->upload()

        $response_arr=array(
            "status" => true,
            "uploaded" => 1,
            "fileName" => $_FILES['upload']['name'],
            "url" => $response['secure_url']
        );
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