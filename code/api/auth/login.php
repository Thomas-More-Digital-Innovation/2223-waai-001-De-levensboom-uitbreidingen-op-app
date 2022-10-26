<?php

session_start();

// include database and object files
include_once '../config/database.php';
include_once '../objects/begeleider.php';
include_once '../objects/afdelingBegeleiderClient.php';
include_once '../objects/contactGegevens.php';
include_once '../objects/afdeling.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare begeleider object
$begeleider = new Begeleider($db);

// prepare afdelingBegeleiderClient object
$afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

// prepare afdeling object
$afdeling = new Afdeling($db);

// prepare contactGegevens object
$contactGegevens = new ContactGegevens($db);

// set property values
$email = $_POST['email'];
$wachtwoord = $_POST['wachtwoord'];

// read all contactGegevens
$stmt = $contactGegevens->read();
$num = $stmt->rowCount();

$gotcContactGegevensId = false;
if($num > 0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($row['email'] == $email){
            $begeleider->contactGegevensId = $row['contactGegevensId'];
            $gotcContactGegevensId = true;
        }
    }
}

if($gotcContactGegevensId){
    // read all contactGegevens
    $stmt = $begeleider->read_by_email();
    $num = $stmt->rowCount();

    if($num > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set begeleiderId property voor afdelingBegeleiderClient 
        $afdelingBegeleiderClient->begeleiderId = $row["begeleiderId"];
        $stmtAB = $afdelingBegeleiderClient->readAfdelingenForBegeleider();

        // afdelingen array
        $afdelingenId_arr=array();
        while ($rowAB = $stmtAB->fetch(PDO::FETCH_ASSOC)){
            //voeg afdelingId toe aan array
            array_push($afdelingenId_arr, $rowAB["afdelingId"]);
        }

        if(password_verify( $wachtwoord , $row['wachtwoord'])){
            $_SESSION['login'] = 1;
            $_SESSION['begeleiderId'] = $row["begeleiderId"];
            $_SESSION['voornaam'] = $row["voornaam"];
            $_SESSION['achternaam'] = $row["achternaam"];
            $_SESSION['functie'] = $row["functie"];
            $_SESSION['afdelingen'] = $afdelingenId_arr;
            $response_arr=array(
                "status" => true,
                "message" => "Inloggen geslaagd!"
            );
        } else {
            $response_arr=array(
                "status" => false,
                "message" => "Foutief wachtwoord!"
            );
        }
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Foutief email!"
        );
    }
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Foutief email!"
    );
}

print_r(json_encode($response_arr));

?>