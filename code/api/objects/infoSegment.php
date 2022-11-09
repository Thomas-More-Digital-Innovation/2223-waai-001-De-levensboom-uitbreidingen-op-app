<?php
class InfoSegment{
 
    // database connection and table name
    private $conn;
 
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
                    infoSegment
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
                    infoSegment
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
                    infoSegment
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
                    infoSegment
                WHERE
                    infoSegmentId= :infoSegmentId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':infoSegmentId' => $this->infoSegmentId]);
        return $stmt;
    }

    // create infoSegment
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  infoSegment
                        (`titel`, `isVolwassenen`, `volgordeNr`, `isActief`)
                  VALUES
                        (:title, :isVolwassenen, :volgordeNr ,true)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute([':title' => $this->titel, ':isVolwassenen' => $this->isVolwassenen, ':volgordeNr' => $this->volgordeNr])){
            $this->infoSegmentId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update infoSegment 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    infoSegment
                SET
                    titel=:title, isVolwassenen=:isVolwassenen
                WHERE
                    infoSegmentId=:infoSegmentId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute([':title' => $this->titel, ':isVolwassenen' => $this->isVolwassenen, ':infoSegmentId' => $this->infoSegmentId])){
            return true;
        }
        return false;
    }

    // update infoSegment volgorde 
    function updateVolgordeNr(){
    
        // query to insert record
        $query = 'UPDATE
                    infoSegment
                SET
                    volgordeNr=:volgordeNr
                WHERE
                    infoSegmentId=:infoSegmentId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute([':volgordeNr' => $this->volgordeNr, ':infoSegmentId' => $this->infoSegmentId])){
            return true;
        }
        return false;
    }

    // delete infoSegment
    function delete(){
        
        // query to insert record
        $query = 'UPDATE
                    infoSegment
                SET
                    isActief=false
                WHERE
                    infoSegmentId=:infoSegmentId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute([':infoSegmentId' => $this->infoSegmentId])){
            return true;
        }
        return false;
    }
}