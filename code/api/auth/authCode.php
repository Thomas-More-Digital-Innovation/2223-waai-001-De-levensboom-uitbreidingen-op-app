<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/secretCodes.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare secretCode object
    $secretCodes = new SecretCodes($db);

    // read all contactGegevens
    $stmt = $secretCodes->read();
    $num = $stmt->rowCount();

    if($num > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $createdAt= new DateTime($row['createdAt']);
            $now = new DateTime();
            $interval = $createdAt->diff($now);
            $isValid = true;
            if($interval->i > 9){
                $isValid = false;
            } else if($interval->h > 0){
                $isValid = false;
            } else if($interval->d > 0){
                $isValid = false;
            } else if($interval->days > 0){
                $isValid = false;
            } else if($interval->m > 0){
                $isValid = false;
            } else if($interval->y > 0){
                $isValid = false;
            }

            if($isValid){
                if(password_verify( $_POST['code'] , $row['secretCode'])){
                    $succesResponse_arr=array(
                        "status" => true,
                        "message" => "Code is valide",
                        "secretCodeId" => $row['secretCodeId'],
                    );
                } else {
                    $response_arr=array(
                        "status" => false,
                        "message" => "Link is niet valide",
                    ); 
                }
            } else{
                $secretCodes->secretCodeId = $row['secretCodeId'];
                $secretCodes->delete();
                $response_arr=array(
                    "status" => false,
                    "message" => "Link is verlopen",
                );
            }
        }
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "code bestaat niet",
        );
    }

    if(isset($succesResponse_arr) == true) {
        print_r(json_encode($succesResponse_arr));
    } else {
        print_r(json_encode($response_arr));
    }

    
?>