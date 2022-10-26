<?php

session_start();

// include database and object files
include_once '../config/database.php';
include_once '../objects/begeleider.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare begeleider object
$begeleider = new Begeleider($db);

// set property values
$begeleider->begeleiderId = $_SESSION['begeleiderId'];
$wachtwoord = $_POST['wachtwoord'];

$stmt = $begeleider->getWachtwoord();
$num = $stmt->rowCount();
if($num > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(password_verify( $wachtwoord , $row['wachtwoord'])){
        $response_arr=array(
            "status" => true,
            "message" => "Wachtwoord juist!"
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
        "message" => "Er is iets fout gelopen!"
    );
}


print_r(json_encode($response_arr));

?>