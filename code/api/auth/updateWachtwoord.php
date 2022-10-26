<?php

session_start();

if (isset($_SESSION["login"])) {
    if ($_SESSION["login"] == 1) {

        // include database and object files
        include_once '../config/database.php';
        include_once '../objects/begeleider.php';

        // get database connection
        $database = new Database();
        $db = $database->getConnection();

        // prepare begeleider object
        $begeleider = new Begeleider($db);

        $begeleider->begeleiderId = $_SESSION['begeleiderId'];
        $begeleider->wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);

        if ($begeleider->resetPassword()) {
            $response_arr = array(
                "status" => true,
                "message" => "Wachtwoord is bewerkt"
            );
        } else {
            $response_arr = array(
                "status" => false,
                "message" => "Wachtwoord bewerken mislukt"
            );
        }
    } else {
        $response_arr = array(
            "status" => false,
            "message" => "Authenticatie mislukt"
        );
    }
} else {
    $response_arr = array(
        "status" => false,
        "message" => "Authenticatie mislukt"
    );
}

print_r(json_encode($response_arr));
