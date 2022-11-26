<?php

class Database{

 
    // specify your own database credentials
    private $host;    
    private $db_name;
    private $username;
    private $password;   
    public $conn;

    public function __construct(){
        $this->getEnv();
        $this->host= $_ENV['DATABASE_HOST'];
        $this->db_name= $_ENV['DATABASE_NAAM'];
        $this->username= $_ENV['DATABASE_USERNAME'];
        $this->password = $_ENV['DATABASE_PASS'];
    }

    private function getEnv(){
        $currentDir = __DIR__;
        $apiPos = strpos($currentDir,"api");
        $rootDir = substr($currentDir, 0, $apiPos);
        $wantedSubDir = 'vendor/autoload.php';
        $wantedRequireDir = $rootDir . $wantedSubDir;
        require($wantedRequireDir);

        $dotenv = Dotenv\Dotenv::createImmutable($rootDir);
        $dotenv->load();
    }

 
    // get the database connection
    public function getConnection(){
        
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>