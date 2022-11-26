<?php

// Uncomment voor error reporting aan te zetten (debugging)
// error_reporting(-1);
// ini_set('display_errors', 'On');

use Firebase\JWT\JWT;
use Dotenv\Dotenv;

require_once('../../vendor/autoload.php');

// include database and object files
include_once '../config/database.php';
include_once '../objects/client.php';
include_once '../objects/begeleider.php';
include_once '../objects/afdelingBegeleiderClient.php';
include_once '../objects/contactGegevens.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare begeleider object
$client = new Client($db);

// prepare afdelingBegeleiderClient object
$afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

// prepare afdeling object
$begeleider = new Begeleider($db);

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
            $client->contactGegevensId = $row['contactGegevensId'];
            $gotcContactGegevensId = true;
        }
    }
}

if($gotcContactGegevensId){
    // read all contactGegevens
    $stmt = $client->read_by_email();
    $num = $stmt->rowCount();

    if($num > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);


        if(password_verify( $wachtwoord , $row['wachtwoord'])){

            // Env variabelen ophalen
            $currentDir = __DIR__;
            $apiPos = strpos($currentDir,"api");
            $rootDir = substr($currentDir, 0, $apiPos);
            $dotenv = Dotenv::createImmutable($rootDir);
            $dotenv->load();

            //Nodige data ophalen/creeren voor de token 
            $secretKey  = $_ENV['JWT_SECRET_KEY'];
            $issuedAt   = new DateTimeImmutable();
            $serverName = $_ENV['WEBAPP_LINK'];
            $clientId   = $row["clientId"];

            //Data voor token bundelen 
            $data = [
                'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
                'iss'  => $serverName,                       // Issuer
                'nbf'  => $issuedAt->getTimestamp(),         // Not before
                'clientId' => $clientId,                     // User id
            ];
           
            //token genereren 
            $token = JWT::encode(
                $data,
                $secretKey,
                'HS512'
            );
            
            $response_arr=array(
                "status" => true,
                "message" => "Inloggen geslaagd!",
                "token" => $token,
                "voornaam" => $row["voornaam"],
                "achternaam" => $row["achternaam"],
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

if(!$response_arr["status"]) {
    header('HTTP/1.0 400 Bad Request');
}

print_r(json_encode($response_arr));

?>