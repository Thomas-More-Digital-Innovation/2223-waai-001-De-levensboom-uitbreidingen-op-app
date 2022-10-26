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

        // prepare contactGegevens object
        $contactGegevens = new ContactGegevens($db);

        // set contactGegevens property values
        $contactGegevens->straat = $_POST['straat'];
        $contactGegevens->huisNr = $_POST['huisNr'];
        $contactGegevens->woonplaats = $_POST['woonplaats'];
        $contactGegevens->postcode = $_POST['postcode'];
        $contactGegevens->telNummer = $_POST['telNummer'];
        $contactGegevens->email = $_POST['email'];

        // create the contactgegevens
        $cgCreated = false;
        if($contactGegevens->create()){
            $cgCreated = true;
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Contact gegevens aanmaken mislukt!"
            );
        }

        if($cgCreated) {
            // prepare afdeling object
            $afdeling = new Afdeling($db);
            
            // set afdeling property values
            $afdeling->naam = $_POST['naam'];
            $afdeling->contactGegevensId = $contactGegevens->contactGegevensId;

            // create the afdeling
            if($afdeling->create()){
                $response_arr=array(
                    "status" => true,
                    "message" => "Afdeling succesvol toegevoegd!",
                    "afdelingId" => $afdeling->afdelingId,
                    "naam" => $afdeling->naam,
                    "contactGegevensId" => $afdeling->contactGegevensId
                );
            }
            else{
                $contactGegevens->delete();
                $response_arr=array(
                    "status" => false,
                    "message" => "Afdeling aanmaken mislukt!"
                );
            }
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