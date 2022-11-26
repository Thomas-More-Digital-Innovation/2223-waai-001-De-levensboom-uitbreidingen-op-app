<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/begeleider.php';
        include_once '../objects/afdelingBegeleiderClient.php';
        include_once '../objects/contactGegevens.php';
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare begeleider object
        $begeleider = new Begeleider($db);

        // prepare afdelingBegeleiderClient object
        $afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

        // prepare contactGegevens object
        $contactGegevens = new ContactGegevens($db);

        // set begeleider property values
        $begeleider->begeleiderId = $_POST['begeleiderId'];
        $begeleider->voornaam = $_POST['voornaam'];
        $begeleider->achternaam = $_POST['achternaam'];
        $begeleider->functie = $_POST['functie'];

        // read the details of begeleider 
        $stmt = $begeleider->read_single();
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set ID property of contactGegevens 
        $begeleider->contactGegevensId = $row['contactGegevensId'];

        // set contactGegevens property values
        $contactGegevens->contactGegevensId = $row['contactGegevensId'];
        $contactGegevens->straat = $_POST['straat'];
        $contactGegevens->huisNr = $_POST['huisNr'];
        $contactGegevens->woonplaats = $_POST['woonplaats'];
        $contactGegevens->postcode = $_POST['postcode'];
        $contactGegevens->telNummer = $_POST['telNummer'];
        $contactGegevens->email = $_POST['email'];

        $afdelingIds = isset($_POST['afdelingen']) ? $_POST['afdelingen'] : []; 

        // set begeleiderId property voor afdelingBegeleiderClient 
        $afdelingBegeleiderClient->begeleiderId = $_POST['begeleiderId'];
        // read the details of afdelingBegeleiderClient 
        $stmtAB = $afdelingBegeleiderClient->readAfdelingenForBegeleider();

        $afdelingenUpdatenSuccess = true;
        $whileCount = 0;
        while ($rowAB = $stmtAB->fetch(PDO::FETCH_ASSOC)){

            $afdelingBegeleiderClient->afdelingBegeleiderClientId = $rowAB["afdelingBegeleiderClientId"];

            //per afdeling updaten, en verwijderen als er minder zijn er eerst waren 
            if(isset($afdelingIds[$whileCount])){
                // set properties voor afdelingBegeleider 
                $afdelingBegeleiderClient->afdelingId = $afdelingIds[$whileCount];
                // update afdelingBegeleiderClient
                if($afdelingBegeleiderClient->updateBegeleiderAfdeling()){
                    $afdelingenUpdatenSuccess = true;
                }
                else {
                    $afdelingenUpdatenSuccess = false;
                }
            } else {
                if($afdelingBegeleiderClient->delete()){
                    $afdelingenUpdatenSuccess = true;
                } else {
                    $afdelingenUpdatenSuccess = false;
                }
            }
            $whileCount += 1;
        }

        while ($whileCount < count($afdelingIds)){
            // set afdelingId voor afdelingBegeleiderClient
            $afdelingBegeleiderClient->afdelingId = $afdelingIds[$whileCount];
            // create afdelingBegeleiderClient
            if($afdelingBegeleiderClient->createBegeleiderAfdeling()){
                $afdelingenUpdatenSuccess = true;
            }
            else {
                $afdelingenUpdatenSuccess = false;
            }
            $whileCount += 1;
        }

        //check if afdeling updating succesvol was
        if($afdelingenUpdatenSuccess){
            // update de contactGegevens
            if($contactGegevens->update()){
                // update de begeleider
                if($begeleider->update()){
                    $response_arr=array(
                        "status" => true,
                        "message" => "Begeleider succesvol geupdate!"
                    );
                }
                else{
                    $response_arr=array(
                        "status" => false,
                        "message" => "Begeleider bewerken mislukt!"
                    );
                }
            }
            else{
                $response_arr=array(
                    "status" => false,
                    "message" => "Contactgegevens bewerken mislukt!"
                );
            }
        }
        else{
            $response_arr=array(
                "status" => false,
                "message" => "Afdelingen bewerken mislukt!"
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