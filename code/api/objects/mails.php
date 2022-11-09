<?php
class Mails{
 
    // database connection and table name
    private $conn;
 
    // object properties
    public $mailId;
    public $titel;
    public $inhoud;
    public $isActief;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all mails
    function read(){
          
        // select all query
        $query = 'SELECT
                    `mailId`, `titel`, `inhoud`, `isActief`, `createdAt`
                FROM
                    `mails` 
                ORDER BY
                    createdAt DESC';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }


    // get single mails data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `mailId`, `titel`, `inhoud`, `isActief`, `createdAt`
                FROM
                    `mails`
                WHERE
                    mailId= :mailId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute(['mailId' => $this->mailId]);
        return $stmt;
    }



    // update mails 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    `mails`
                SET
                    titel= :titel, inhoud= :inhoud
                WHERE
                    mailId= :mailId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute(['titel' => $this->titel, 'inhoud' => $this->inhoud, 'mailId' => $this->mailId])){
            return true;
        }
        return false;
    }
}

?>