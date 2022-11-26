<?php
class SecretCodes{
 
    // database connection and table name
    private $conn;
    private $table_name = "secretCodes";
 
    // object properties
    public $secretCodeId;
    public $secretCode;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all secretCodes
    function read(){
          
        // select all query
        $query = 'SELECT
                    `secretCodeId`, `secretCode`, `createdAt`
                FROM
                    secretCodes';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // get single secretCode data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `secretCode`, `createdAt`
                FROM
                    secretCodes
                WHERE
                    secretCodeId= :secretCodeId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':secretCodeId' => $this->secretCodeId]);
        return $stmt;
    }

    // create secretCode
    function create(){
        
        // query to insert record
        $query = "INSERT INTO  secretCodes 
                        (`secretCode`,`createdAt`)
                  VALUES
                        (:secretCode,:createdAt)";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute([':secretCode' => $this->secretCode, ':createdAt' => $this->createdAt])){
            $this->secretCodesId = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }

    // delete secretCode
    function delete(){
        
        // query to insert record
        $query = 'DELETE FROM
                    secretCodes
                WHERE
                    secretCodeId= :secretCodeId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute([':secretCodeId' => $this->secretCodeId])){
            return true;
        }
        return false;
    }
}