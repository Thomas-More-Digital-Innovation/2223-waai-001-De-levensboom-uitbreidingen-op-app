<?php
class Mails{
 
    // database connection and table name
    private $conn;
    private $table_name = "mails";
 
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
                    ' . $this->table_name . ' 
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
                    ' . $this->table_name .  ' 
                WHERE
                    mailId='.$this->mailId;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }



    // update mails 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    titel="'.$this->titel.'", inhoud="'.$this->inhoud.'"
                WHERE
                    mailId="'.$this->mailId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}

?>