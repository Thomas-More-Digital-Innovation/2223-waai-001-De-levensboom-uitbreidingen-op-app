<?php

session_start();

if(isset($_SESSION["login"])){
    if($_SESSION["login"] == 1 && $_SESSION["functie"] == "admin"){
 
        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/begeleider.php';
        include_once '../objects/contactGegevens.php';

        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare begeleider object
        $begeleider = new Begeleider($db);
        
        // set begeleider property values
        $begeleider->begeleiderId = isset($_POST['id']) ? $_POST['id'] : "";

        // prepare contactGegevens object
        $contactGegevens = new ContactGegevens($db);

        // read the details of begeleider 
        $stmt = $begeleider->read_single();

        if($stmt->rowCount() > 0){
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

             // set ID property of contactGegevens 
            $contactGegevens->contactGegevensId = $row['contactGegevensId'];

            // remove contactgegevens
            if($contactGegevens->delete()){
                $response_arr=array(
                    "status" => true,
                    "message" => "ContactGegevens zijn verwijdert!"
                );
            }
            else{
                $response_arr=array(
                    "status" => false,
                    "message" => "ContactGegevens verwijderen is mislukt"
                );
            }

            // remove the begeleider
            if($begeleider->delete()){
                $response_arr=array(
                    "status" => true,
                    "message" => "Begeleider is verwijdert!"
                );
            }
            else{
                $response_arr=array(
                    "status" => false,
                    "message" => "Begeleider verwijderen is mislukt"
                );
            }
        } else {
            $response_arr=array(
                "status" => false,
                "message" => "Begeleider niet gevonden"
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