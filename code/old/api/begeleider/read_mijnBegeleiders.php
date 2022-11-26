<?php

// Uncomment voor error reporting aan te zetten  (debugging)
// error_reporting(-1);
// ini_set('display_errors', 'On');

use Firebase\JWT\JWT;
use Dotenv\Dotenv;

require_once('../../vendor/autoload.php');

// include database and object files
include_once '../config/database.php';
include_once '../objects/contactGegevens.php';
include_once '../objects/afdelingBegeleiderClient.php';
include_once '../objects/begeleider.php';
include_once '../objects/afdeling.php';


// De bearer(jwt) token ophalen 
if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
    $response_arr=array(
        "status" => false,
        "message" => "Token not found in request",
    );
} 

//jwt token vallideren 
$validToken = false;
$jwt = isset($matches[1]) ? $matches[1] : null;  
if($jwt) {
    // Env variabelen ophalen
    $currentDir = __DIR__;
    $apiPos = strpos($currentDir,"api");
    $rootDir = substr($currentDir, 0, $apiPos);
    $dotenv = Dotenv::createImmutable($rootDir);
    $dotenv->load();

    //decoderen van token
    $token = JWT::decode($jwt, $_ENV["JWT_SECRET_KEY"],['HS512']);

    //Checken of token valide is 
    $now = new DateTimeImmutable();
    if($token->iss == $_ENV['WEBAPP_LINK'] && $token->nbf < $now->getTimestamp()) {
        $validToken = true;
    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Token is niet valide",
        );
    }
} else {
    $response_arr=array(
        "status" => false,
        "message" => "Token not found in request",
    );
}

if($validToken) {

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare afdelingBegeleiderClient object
    $afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

    // prepare begeleider object
    $begeleider = new Begeleider($db);

    // prepare afdeling object
    $afdeling = new Afdeling($db);

    // prepare contactGegevens object
    $contactGegevens = new ContactGegevens($db);

    // set ID property of afdelingBegeleiderClient 
    $afdelingBegeleiderClient->clientId = $token->clientId;
    // read the afdelingen voor deze client
    $stmtAC = $afdelingBegeleiderClient->readAfdelingenForClient();
    $clientAfdelingen_arr = array();
    if($stmtAC->rowCount() > 0){
        while($rowAC = $stmtAC->fetch(PDO::FETCH_ASSOC)){
            array_push($clientAfdelingen_arr , $rowAC["afdelingId"]);
        }
    }

    // read the begeleiders voor deze client
    $stmt = $afdelingBegeleiderClient->readBegeleidersForClient();

    if($stmt->rowCount() > 0){

        // begeleiders array
        $count = 0;
        $response_arr=array();
        $response_arr["begeleider"]=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            // set ID property voor begeleider 
            $begeleider->begeleiderId = $begeleiderId;
            // read the details of begeleider 
            $stmtB = $begeleider->read_single();
            // get retrieved row from begeleider
            $rowB = $stmtB->fetch(PDO::FETCH_ASSOC); 
            
            if($rowB["isActief"] == true){
                $count += 1;
                // set ID property voor contactGegevens 
                $contactGegevens->contactGegevensId = $rowB["contactGegevensId"];
                // read the details of contactgegevens 
                $stmtCG = $contactGegevens->read_single();
                // get retrieved row from contactgegevens
                $rowCG = $stmtCG->fetch(PDO::FETCH_ASSOC); 

                // set begeleiderId property of afdelingBegeleiderClient 
                $afdelingBegeleiderClient->begeleiderId = $begeleiderId;
                // read the afdelingen voor deze begeleider
                $stmtAB = $afdelingBegeleiderClient->readAfdelingenForBegeleider();
                //Array voor afdelingen die overeen komen tussen begeleider en client
                $overeenKomendeAfdelingenIds_arr = array();
                if($stmtAB->rowCount() > 0){
                    while($rowAB = $stmtAB->fetch(PDO::FETCH_ASSOC)){
                        foreach($clientAfdelingen_arr as $afdelingId){
                            if($afdelingId == $rowAB["afdelingId"]){
                                array_push($overeenKomendeAfdelingenIds_arr , $rowAB["afdelingId"]);
                            }
                        }
                    }
                }

                //De namen ophalen van overeenkomstige afdelingen
                $overeenKomendeAfdelingen_arr = array();
                foreach($overeenKomendeAfdelingenIds_arr as $afdelingId){
                    // set ID property of afdeling 
                    $afdeling->afdelingId = $afdelingId;
                    // read the details of afdeling 
                    $stmtA = $afdeling->read_single();
                    //Zien of er iets if opgehaalt
                    if($stmtA->rowCount() > 0){
                        // get retrieved row
                        $rowA = $stmtA->fetch(PDO::FETCH_ASSOC);
                        //checken of afdeling actief is 
                        if($rowA['isActief'] == true){
                            array_push($overeenKomendeAfdelingen_arr , $rowA["naam"]);
                        }
                    }
                }
    
                $begeleider_item=array(
                    "voornaam" => $rowB["voornaam"],
                    "achternaam" => $rowB["achternaam"],
                    // "straat" => $rowCG['straat'],
                    // "huisNr" => $rowCG['huisNr'],
                    // "woonplaats" => $rowCG['woonplaats'],
                    // "postcode" => $rowCG['postcode'],
                    "telNummer" => $rowCG['telNummer'],
                    "email" => $rowCG['email'],
                    "overeenkomstigeAfdelingen" => $overeenKomendeAfdelingen_arr,
                );

                array_push($response_arr["begeleider"], $begeleider_item);
            }

        }
        
        // response to request
        print_r(json_encode($response_arr["begeleider"]));
        exit; 

    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Geen begeleiders gevonden voor deze client",
        );
    }
}

if(!$response_arr["status"]) {
    header('HTTP/1.0 400 Bad Request');
}

// make response json format
print_r(json_encode($response_arr));

?>