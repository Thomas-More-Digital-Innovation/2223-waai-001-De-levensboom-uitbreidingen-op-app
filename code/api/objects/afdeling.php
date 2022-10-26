<?php
class Afdeling{
 
    // database connection and table name
    private $conn;
    private $table_name = "afdeling";
 
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
                    ' . $this->table_name . ' 
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
                    ' . $this->table_name .  ' 
                WHERE
                    afdelingId= "'.$this->afdelingId.'"';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create afdeling
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .' 
                        (`naam`, `contactGegevensId`, `isActief`)
                  VALUES
                        ("'.$this->naam.'", "'.$this->contactGegevensId.'", true)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->afdelingId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update afdeling 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    naam="'.$this->naam.'", contactGegevensId="'.$this->contactGegevensId.'"
                WHERE
                    afdelingId="'.$this->afdelingId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete afdeling
    function delete(){
        
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    isActief=false
                WHERE
                    afdelingId="'.$this->afdelingId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}