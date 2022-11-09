<?php
class Nieuwtjes{
 
    // database connection and table name
    private $conn;
 
    // object properties
    public $nieuwtjesId;
    public $titel;
    public $korteInhoud;
    public $inhoud;
    public $isActief;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all nieuwtjes
    function read(){
          
        // select all query
        $query = 'SELECT
                    `nieuwtjesId`, `titel`, `korteInhoud`, `inhoud`, `isActief`, `createdAt`
                FROM
                    `nieuwtjes`
                ORDER BY
                    createdAt DESC';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }


    // get single nieuwtjes data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `nieuwtjesId`, `titel`, `korteInhoud`, `inhoud`, `isActief`, `createdAt`
                FROM
                    `nieuwtjes`
                WHERE
                    nieuwtjesId= :nieuwtjesId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute( [':nieuwtjesId' => $this->nieuwtjesId] );
        return $stmt;
    }

    // create nieuwtjes
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO `nieuwtjes`
                        (`titel`,`korteInhoud`, `inhoud`, `isActief`)
                  VALUES
                        (:titel, :korteInhoud, :inhoud, :isActief)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute( [':titel' => $this->titel, ':korteInhoud' => $this->korteInhoud, ':inhoud' => $this->inhoud, ':isActief' => true] )){
            $this->nieuwtjesId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update nieuwtjes 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    `nieuwtjes`
                SET
                    `titel` = :titel, korteInhoud = :korteInhoud, `inhoud` = :inhoud
                WHERE
                    nieuwtjesId= :nieuwtjesId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':titel' => $this->titel, ':korteInhoud' => $this->korteInhoud, ':inhoud' => $this->inhoud, ':nieuwtjesId' => $this->nieuwtjesId] )){
            return true;
        }
        return false;
    }

    // delete nieuwtjes
    function delete(){
        
        // query to insert record
        $query = "UPDATE
                    `nieuwtjes`
                SET
                    isActief= :isActief
                WHERE
                    nieuwtjesId= :nieuwtjesId";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':isActief' => false, ':nieuwtjesId' => $this->nieuwtjesId] )){
            return true;
        }
        return false;
    }
}

?>