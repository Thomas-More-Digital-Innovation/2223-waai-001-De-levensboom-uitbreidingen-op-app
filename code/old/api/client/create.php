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

        // prepare contactGegevens object
        $contactGegevens = new ContactGegevens($db);

        // read all contactGegevens
        $stmt = $contactGegevens->read();
        $num = $stmt->rowCount();
        $emailUsed = false;
        if($num > 0){
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['email'] == $_POST['email']){
                    if($row['isActief']) {
                        $emailUsed = true;
                    }
                }
            }
        }

        // set contactGegevens property values
        $contactGegevens->straat = $_POST['straat'];
        $contactGegevens->huisNr = $_POST['huisNr'];
        $contactGegevens->woonplaats = $_POST['woonplaats'];
        $contactGegevens->postcode = $_POST['postcode'];
        $contactGegevens->telNummer = $_POST['telNummer'];
        $contactGegevens->email = $_POST['email'];

        if($emailUsed == false){
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
                // prepare client object
                $client = new Client($db);

                // geboortedatum formateren naar juiste format
                $geboorteDatumFormated = new DateTime($_POST['geboorteDatum']);
                $geboorteDatumFormated = $geboorteDatumFormated->format('Y-m-d'); 

                // set client property values
                $client->voornaam = $_POST['voornaam'];
                $client->achternaam = $_POST['achternaam'];
                $client->geslacht = $_POST['geslacht'];
                $client->geboorteDatum = $geboorteDatumFormated;
                $client->contactGegevensId = $contactGegevens->contactGegevensId; 

                // create the client
                if($client->create()){

                    $afdelingIds = isset($_POST['afdelingen']) ? $_POST['afdelingen'] : ""; 
                    $begeleiderIds = isset($_POST['begeleiders']) ? $_POST['begeleiders'] : ""; 

                    $afdelingenEnBegeleidersCreated = true;

                    if($afdelingIds != ""){
                        // prepare afdelingBegeleiderClient object
                        $afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);
                        
                        foreach ($afdelingIds as $afdeling) {
                            $afdelingBegeleiderClient->afdelingId = $afdeling;
                            $afdelingBegeleiderClient->clientId = $client->clientId;

                            if($afdelingBegeleiderClient->createClientAfdeling()){
                            } else {
                                $afdelingenEnBegeleidersCreated = false;
                            }
                        }
                    }

                    if($begeleiderIds != ""){
                        // prepare afdelingBegeleiderClient object
                        $afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);
                        
                        foreach ($begeleiderIds as $begeleider) {
                            $afdelingBegeleiderClient->begeleiderId = $begeleider;
                            $afdelingBegeleiderClient->clientId = $client->clientId;

                            if($afdelingBegeleiderClient->createClientBegeleider()){
                            } else {
                                $afdelingenEnBegeleidersCreated = false;
                            }
                        }
                    }
                    
                    if($afdelingenEnBegeleidersCreated) { 
                        $response_arr=array(
                            "status" => true,
                            "message" => "Client succesvol toevoegd!",
                            "clientId" => $client->clientId,
                            "voornaam" => $client->voornaam,
                            "achternaam" => $client->achternaam,
                            "geslacht" => $client->geslacht,
                            "geboortedatum" => $client->geboorteDatum,
                            "contactGegevensId" => $client->contactGegevensId
                        );
                    } else{
                        $contactGegevens->delete();
                        $response_arr=array(
                            "status" => false,
                            "message" => "Afdeling of Begeleider voor client aanmaken mislukt!"
                        );
                    }
                } else{
                    $contactGegevens->delete();
                    $response_arr=array(
                        "status" => false,
                        "message" => "Client account aanmaken mislukt!"
                    );
                }
            }
        } else {
            $response_arr=array(
                "status" => false,
                "message" => "Email is al in gebruik"
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