<?php

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/afdelingBegeleiderClient.php';
    include_once '../objects/begeleider.php';
    
    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare begeleider object
    $begeleider = new Begeleider($db);

    // prepare afdelingBegeleiderClient object
    $afdelingBegeleiderClient = new AfdelingBegeleiderClient($db);

    // set afdeling ID property of afdelingBegeleiderClient 
    $afdelingBegeleiderClient->afdelingId = isset($_GET['afdelingId']) ? $_GET['afdelingId'] : "";

    // read the begeleiders per afdeling
    $stmt = $afdelingBegeleiderClient->readBegeleidersForAfdeling();

    if($stmt->rowCount() > 0){

        // begeleiders array
        $begeleiders=array();
        $begeleidersAfdelingId_arr=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            // set ID property voor afdeling 
            $begeleider->begeleiderId = $row["begeleiderId"];
            // read the details of afdeling 
            $stmtB = $begeleider->read_single();
            // get retrieved row from afdeling
            $rowB = $stmtB->fetch(PDO::FETCH_ASSOC);

            // voeg afdeling toe aan array
            array_push($begeleiders, $rowB);  
            
            //voeg afdelingBegeleiderId toe aan array
            array_push($begeleidersAfdelingId_arr, $row["afdelingBegeleiderClientId"]);
        }

        // create array
        $response_arr=array(
            "status" => true,
            "begeleiders" => $begeleiders,
            "begeleidersAfdelingIds" => $begeleidersAfdelingId_arr,
        );

    } else {
        $response_arr=array(
            "status" => false,
            "message" => "Geen begeleiders gevonden voor deze afdeling",
        );
    }

    // make response json format
    print_r(json_encode($response_arr));

?>