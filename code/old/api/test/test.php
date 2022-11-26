<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;



    $email = $_POST["email"]; 
    $titel = $_POST['titel'];
    $html = $_POST['html'];
    $rawTekst = $_POST['rawTekst'];
    $linkTekst = $_POST['linkTekst'];


    // create test array
    $test_arr=array(
        "email" => $email,
        "titel" => $titel,
        "html" => $html,
        "rawTekst" => $rawTekst,
        "linkTekst" => $linkTekst,
        "postDing" => $_POST
    );


    print_r(json_encode($test_arr));
?>