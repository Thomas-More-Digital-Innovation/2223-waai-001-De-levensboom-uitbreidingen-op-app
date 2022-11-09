<?php
class Afdeling{
 
    // database connection and table name
    private $conn;
 
    // object properties
    public $afdelingId;
    public $naam;
    public $contactGegevensId;
    public $isActief;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all afdelingen
    function read(){
          
        // select all query
        $query = 'SELECT
                    `afdelingId`, `naam`, `contactGegevensId`, `isActief`, `createdAt`
                FROM
                    `afdeling`
                ORDER BY
                    afdelingId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // get single afdeling data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `afdelingId`, `naam`, `contactGegevensId`, `isActief`, `createdAt`
                FROM
                    `afdeling`
                WHERE
                    afdelingId= :afdelingId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':afdelingId' => $this->afdelingId]);

        return $stmt;
    }

    // create afdeling
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  `afdeling`
                        (`naam`, `contactGegevensId`, `isActief`)
                  VALUES
                        (:naam, :contactGegevensId, :isActief)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute([':naam' => $this->naam, ':contactGegevensId' => $this->contactGegevensId, ':isActief' => true])){
            $this->afdelingId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update afdeling 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    `afdeling`
                SET
                    naam=:naam, contactGegevensId = :contactGegevensId
                WHERE
                    afdelingId = :afdelingId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute([':naam' => $this->naam, ':contactGegevensId' => $this->contactGegevensId, ':afdelingId' => $this->afdelingId])){
            return true;
        }
        return false;
    }

    // delete afdeling
    function delete(){
        
        // query to insert record
        $query = 'UPDATE
                    `afdeling`
                SET
                    isActief=false
                WHERE
                    afdelingId=:afdelingId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute([':afdelingId' => $this->afdelingId])){
            return true;
        }
        return false;
    }
}