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
                // prepare begeleider object
                $begeleider = new Begeleider($db);

                // set begeleider property values
                $begeleider->voornaam = $_POST['voornaam'];
                $begeleider->achternaam = $_POST['achternaam'];
                $begeleider->functie = $_POST['functie'];
                $begeleider->contactGegevensId = $contactGegevens->contactGegevensId; 

                // create the begeleider
                if($begeleider->create()){

                    $afdelingIds = isset($_POST['afdelingen']) ? $_POST['afdelingen'] : ""; 

                    $afdelingenCreated = true;

                    if($afdelingIds != ""){
                        // prepare afdelingBegeleiderClient object
                        $afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);
                        
                        foreach ($afdelingIds as $afdeling) {
                            $afdelingBegeleiderClient->afdelingId = $afdeling;
                            $afdelingBegeleiderClient->begeleiderId = $begeleider->begeleiderId;

                            if($afdelingBegeleiderClient->createBegeleiderAfdeling()){
                                
                            } else {
                                $afdelingenCreated = false;
                            }
                        }
                    }
                    

                    if($afdelingenCreated) { 
                        $response_arr=array(
                            "status" => true,
                            "message" => "Begeleider succesvol toevoegd!",
                            "begeleiderId" => $begeleider->begeleiderId,
                            "voornaam" => $begeleider->voornaam,
                            "achternaam" => $begeleider->achternaam,
                            "functie" => $begeleider->functie,
                            "contactGegevensId" => $begeleider->contactGegevensId
                        );
                    } else{
                        $contactGegevens->delete();
                        $response_arr=array(
                            "status" => false,
                            "message" => "Afdeling voor begeleider aanmaken mislukt!"
                        );
                    }
                } else{
                    $contactGegevens->delete();
                    $response_arr=array(
                        "status" => false,
                        "message" => "Begeleider account aanmaken mislukt!"
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