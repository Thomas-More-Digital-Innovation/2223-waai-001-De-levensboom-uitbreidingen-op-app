<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/client.php';
        include_once '../objects/afdelingBegeleiderClient.php';
        include_once '../objects/contactGegevens.php';
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare client object
        $client = new Client($db);

        // prepare afdelingBegeleiderClient object
        $afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

        // prepare contactGegevens object
        $contactGegevens = new ContactGegevens($db);

        // geboortedatum formateren naar juiste format
        $geboorteDatumFormated = new DateTime($_POST['geboorteDatum']);
        $geboorteDatumFormated = $geboorteDatumFormated->format('Y-m-d'); 

        // set client property values
        $client->clientId = $_POST['clientId'];
        $client->voornaam = $_POST['voornaam'];
        $client->achternaam = $_POST['achternaam'];
        $client->geslacht = $_POST['geslacht'];
        $client->geboorteDatum = $geboorteDatumFormated;
        $client->tevredenheidsMetingVerstuurd = $_POST['tevredenheidsMetingVerstuurd'];

        // read the details of client 
        $stmt = $client->read_single();
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // // set ID property of contactGegevens 
        $client->contactGegevensId = $row['contactGegevensId'];

        // set contactGegevens property values
        $contactGegevens->contactGegevensId = $row['contactGegevensId'];
        $contactGegevens->straat = $_POST['straat'];
        $contactGegevens->huisNr = $_POST['huisNr'];
        $contactGegevens->woonplaats = $_POST['woonplaats'];
        $contactGegevens->postcode = $_POST['postcode'];
        $contactGegevens->telNummer = $_POST['telNummer'];
        $contactGegevens->email = $_POST['email'];


        //////////// Afdelingen van client updaten ////////////

        $afdelingIds = isset($_POST['afdelingen']) ? $_POST['afdelingen'] : []; 

        // set clientId property voor afdelingBegeleiderClient 
        $afdelingBegeleiderClient->clientId = $_POST['clientId'];
        $afdelingenEnBegeleidersUpdatenSuccess = true;

        // read the details of afdelingBegeleiderClient 
        $stmtAB = $afdelingBegeleiderClient->readAfdelingenForClient();
        $whileCount = 0;
        while ($rowAB = $stmtAB->fetch(PDO::FETCH_ASSOC)){

            $afdelingBegeleiderClient->afdelingBegeleiderClientId = $rowAB["afdelingBegeleiderClientId"];

            //per afdeling updaten, en verwijderen als er minder zijn er eerst waren 
            if(isset($afdelingIds[$whileCount])){
                // set properties voor afdelingBegeleider 
                $afdelingBegeleiderClient->afdelingId = $afdelingIds[$whileCount];
                // update afdelingBegeleiderClient
                if($afdelingBegeleiderClient->updateClientAfdeling()){
                }
                else {
                    $afdelingenEnBegeleidersUpdatenSuccess = false;
                }
            } else {
                if($afdelingBegeleiderClient->delete()){
                } else {
                    $afdelingenEnBegeleidersUpdatenSuccess = false;
                }
            }
            $whileCount += 1;
        }

        while ($whileCount < count($afdelingIds)){
            // set afdelingId voor afdelingBegeleiderClient
            $afdelingBegeleiderClient->afdelingId = $afdelingIds[$whileCount];
            // create afdelingBegeleiderClient
            if($afdelingBegeleiderClient->createClientAfdeling()){
            }
            else {
                $afdelingenEnBegeleidersUpdatenSuccess = false;
            }
            $whileCount += 1;
        }

        //////////// Begeleiders van client updaten ////////////

        $begeleiderIds = isset($_POST['begeleiders']) ? $_POST['begeleiders'] : []; 

        // read the details of afdelingBegeleiderClient 
        $stmtBC = $afdelingBegeleiderClient->readBegeleidersForClient();
        $whileCount = 0;
        while ($rowBC = $stmtBC->fetch(PDO::FETCH_ASSOC)){

            $afdelingBegeleiderClient->afdelingBegeleiderClientId = $rowBC["afdelingBegeleiderClientId"];

            //per begeleider updaten, en verwijderen als er minder zijn er eerst waren 
            if(isset($begeleiderIds[$whileCount])){
                // set properties voor begeleiderClient
                $afdelingBegeleiderClient->begeleiderId = $begeleiderIds[$whileCount];
                // update afdelingBegeleiderClient
                if($afdelingBegeleiderClient->updateClientBegeleider()){
                }
                else {
                    $afdelingenEnBegeleidersUpdatenSuccess = false;
                }
            } else {
                if($afdelingBegeleiderClient->delete()){
                } else {
                    $afdelingenEnBegeleidersUpdatenSuccess = false;
                }
            }
            $whileCount += 1;
        }

        while ($whileCount < count($begeleiderIds)){
            // set begeleiderId voor afdelingBegeleiderClient
            $afdelingBegeleiderClient->begeleiderId = $begeleiderIds[$whileCount];
            // create afdelingBegeleiderClient
            if($afdelingBegeleiderClient->createClientBegeleider()){
            }
            else {
                $afdelingenEnBegeleidersUpdatenSuccess = false;
            }
            $whileCount += 1;
        }


        //check if afdeling updating succesvol was
        if($afdelingenEnBegeleidersUpdatenSuccess){
            // update de contactGegevens
            if($contactGegevens->update()){
                // update de client
                if($client->update()){
                    $response_arr=array(
                        "status" => true,
                        "message" => "Client succesvol geupdate!",
                        "postDing" => $_POST
                    );
                }
                else{
                    $response_arr=array(
                        "status" => false,
                        "message" => "Client bewerken mislukt!"
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
                "message" => "Afdelingen/begeleiders bewerken mislukt!"
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