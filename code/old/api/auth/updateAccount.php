<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/begeleider.php';
        include_once '../objects/contactGegevens.php';
        
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare begeleider object
        $begeleider = new Begeleider($db);

        // prepare contactGegevens object
        $contactGegevens = new ContactGegevens($db);

        // set begeleider property values
        $begeleider->begeleiderId = $_SESSION['begeleiderId'];
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


        // update de contactGegevens
        if($contactGegevens->update()){
            // update de begeleider
            if($begeleider->update()){
                $_SESSION['voornaam'] = $_POST['voornaam'];
                $_SESSION['achternaam'] = $_POST['achternaam'];
                $response_arr=array(
                    "status" => true,
                    "message" => "Account succesvol geupdate!"
                );
            }
            else{
                $response_arr=array(
                    "status" => false,
                    "message" => "Account bewerken mislukt!"
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