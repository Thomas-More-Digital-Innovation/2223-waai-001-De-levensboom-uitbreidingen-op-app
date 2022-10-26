<?php
    session_start();

    if(isset($_SESSION["login"])){
        if($_SESSION["login"] == 1){
 
            include_once 'objects/mailer.php';

            // get email adres
            $email = $_POST['email'];

            // prepare mailer object
            $mailer = new Mailer();

            $mailer->receiver = $email;
            $mailer->subject = $_POST['titel'];
            $mailer->message = $_POST['html'];
            $mailer->altMessage = $_POST['rawTekst'];

            $mailer->sentMail();

            $response_arr=array(
                "status" => true,
                "message" => "Mail is succesvol verstuurd"
            );

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