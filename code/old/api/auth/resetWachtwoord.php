<?php

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/begeleider.php';
    include_once '../objects/secretCodes.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare secretCode object
    $secretCodes = new SecretCodes($db);
    $secretCodes->secretCodeId = $_POST['codeId'];

    // read all secretCodes
    $stmt = $secretCodes->read_single();
    $num = $stmt->rowCount();

    $isValid = false;

    if($num > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify( $_POST['code'] , $row['secretCode'])){
            $isValid= true;
            $secretCodes->secretCodeId = $_POST['codeId'];
            $secretCodes->delete();
        }
    } 

    if($isValid){
        // prepare begeleider object
        $begeleider = new Begeleider($db);

        $begeleider->begeleiderId = $_POST['id'];
        $begeleider->wachtwoord = password_hash($_POST['wachtwoord'],PASSWORD_DEFAULT);

        if($begeleider->resetPassword()){
            $response_arr=array(
                "status" => true,
                "message" => "Wachtwoord is gereset"
            );
        } else {
            $response_arr=array(
                "status" => false,
                "message" => "Wachtwoord resetten mislukt"
            );
        }
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Code is niet valide"
        ); 
    }

    
    
    print_r(json_encode($response_arr));
?>