<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && ($_SESSION["functie"] == "admin" || $_SESSION["functie"] == "afdelingHoofd")){

        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/tevredenheidsMeting.php';
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare tevredenheidsMeting object
        $tevredenheidsMeting = new TevredenheidsMeting($db);
        // read the details of tevredenheidsMeting 
        $stmt = $tevredenheidsMeting->read_first();

        if($stmt->rowCount() > 0){
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // create array
            $response_arr=array(
                "tevredenheidsMetingId" => $row['tevredenheidsMetingId']+0,
                "formLink" => $row['formLink'],
                "createdAt" => $row['createdAt']
            );

        } else {
            $response_arr=array(
                "status" => false,
                "message" => "Tevredenheids meting bestaat niet",
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

// make response json format
print_r(json_encode($response_arr));

?>