<?php
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;

     class Mailer{

        public $message;
        public $altMessage;
        public $receiver;
        public $subject;
        public $link;

        private $host;
        private $username;
        private $password;


        public function __construct(){
            $this->getEnv();
            $this->link= $_ENV['WEBAPP_LINK'];
            $this->host= $_ENV['EMAIL_HOST'];
            $this->username= $_ENV['EMAIL_USERNAME'];
            $this->password= $_ENV['EMAIL_PASSWORD'];
        }

        private function getEnv(){
            $currentDir = __DIR__;
            $apiPos = strpos($currentDir,"api");
            $rootDir = substr($currentDir, 0, $apiPos);
            $wantedSubDir = 'vendor/autoload.php';
            $wantedRequireDir = $rootDir . $wantedSubDir;

            //Load Composer's autoload
            require($wantedRequireDir);
    
            $dotenv = Dotenv\Dotenv::createImmutable($rootDir);
            $dotenv->load();
        }

        public function getCredentials(){
            
            echo $this->password;
        }

        public function sentMail(){

            $mail = new PHPMailer(true);

            //Disable SMTP debugging, enable for debug by placing value 3
            $mail->SMTPDebug = false;                               
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();            
            //Set SMTP host name smtp                         
            $mail->Host = $this->host; 
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;                          
            //Provide username and password     
            $mail->Username = $this->username;                 
            $mail->Password = $this->password;                           
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls"; //ssl tls                          
            //Set TCP port to connect to
            $mail->Port = 587; //587(TLS) 465(SSL)


            $mail->From = $this->username;
            $mail->FromName = "De Waaiburg";

            $mail->addAddress($this->receiver);

            $mail->isHTML(true);

            $mail->Subject = $this->subject;
            $mail->Body = $this->message;
            $mail->AltBody = $this->altMessage;


            
            try {
                $mail->send();
            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }

        }

     }
?>