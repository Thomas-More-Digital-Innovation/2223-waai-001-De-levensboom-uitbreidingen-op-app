<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/afdeling.php';
        include_once '../objects/contactGegevens.php';
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare afdeling object
        $afdeling = new Afdeling($db);

        // prepare contactGegevens object
        $contactGegevens = new ContactGegevens($db);
        
        // set afdeling property values
        $afdeling->afdelingId = $_POST['afdelingId'];
        $afdeling->naam = $_POST["naam"];

        // read the details of afdeling 
        $stmt = $afdeling->read_single();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set ID property of contactGegevens 
        $afdeling->contactGegevensId = $row['contactGegevensId'];

        // set contactGegevens property values
        $contactGegevens->contactGegevensId = $row['contactGegevensId'];
        $contactGegevens->straat = $_POST['straat'];
        $contactGegevens->huisNr = $_POST['huisNr'];
        $contactGegevens->woonplaats = $_POST['woonplaats'];
        $contactGegevens->postcode = $_POST['postcode'];
        $contactGegevens->telNummer = $_POST['telNummer'];
        $contactGegevens->email = $_POST['email'];
        
        // update de contactGegevens
        if($contactGegevens->update()){
            // update de afdeling
            if($afdeling->update()){
                $response_arr=array(
                    "status" => true,
                    "message" => "Afdeling succesvol geupdate!"
                );
            }
            else{
                $response_arr=array(
                    "status" => false,
                    "message" => "Afdeling bewerken mislukt!"
                );
            }
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Contactgegevens bewerken mislukt!"
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