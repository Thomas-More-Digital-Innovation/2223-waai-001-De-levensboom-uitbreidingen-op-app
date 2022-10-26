<?php
class InfoSegment{
 
    // database connection and table name
    private $conn;
    private $table_name = "infoSegment";
 
    // object properties
    public $infoSegmentId;
    public $titel;
    public $isVolwassenen;
    public $volgordeNr;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all infoSegmenten
    function read(){
          
        // select all query
        $query = 'SELECT
                    `infoSegmentId`, `titel`, `isVolwassenen`, `volgordeNr`, `createdAt`, `isActief`
                FROM
                    ' . $this->table_name . ' 
                ORDER BY
                    volgordeNr';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // read volwassenen infoSegmenten
    function readVolwassenen(){
          
        // select all query
        $query = 'SELECT
                    `infoSegmentId`, `titel`, `isVolwassenen`, `volgordeNr`, `createdAt`, `isActief`
                FROM
                    ' . $this->table_name . ' 
                WHERE 
                    isVolwassenen
                ORDER BY
                    volgordeNr';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // read jongeren infoSegmenten
    function readJongeren(){
          
        // select all query
        $query = 'SELECT
                    `infoSegmentId`, `titel`, `isVolwassenen`, `volgordeNr`, `createdAt`, `isActief`
                FROM
                    ' . $this->table_name . ' 
                WHERE 
                    isVolwassenen = "0"
                ORDER BY
                    volgordeNr';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // get single infoSegment data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `infoSegmentId`, `titel`, `isVolwassenen`, `volgordeNr`, `createdAt`, `isActief`
                FROM
                    ' . $this->table_name .  ' 
                WHERE
                    infoSegmentId= "'.$this->infoSegmentId.'"';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create infoSegment
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .' 
                        (`titel`, `isVolwassenen`, `volgordeNr`, `isActief`)
                  VALUES
                        ("'.$this->titel.'", "'.$this->isVolwassenen.'", "'.$this->volgordeNr.'",true)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->infoSegmentId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update infoSegment 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    titel="'.$this->titel.'", isVolwassenen="'.$this->isVolwassenen.'"
                WHERE
                    infoSegmentId="'.$this->infoSegmentId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // update infoSegment volgorde 
    function updateVolgordeNr(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    volgordeNr="'.$this->volgordeNr.'"
                WHERE
                    infoSegmentId="'.$this->infoSegmentId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete infoSegment
    function delete(){
        
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    isActief=false
                WHERE
                    infoSegmentId="'.$this->infoSegmentId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}