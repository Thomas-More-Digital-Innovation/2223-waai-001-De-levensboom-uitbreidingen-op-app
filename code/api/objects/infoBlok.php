<?php
class InfoBlok{
 
    // database connection and table name
    private $conn;
 
    // object properties
    public $infoBlokId;
    public $titel;
    public $inhoud;
    public $blokFotoUrl;
    public $meerInfoLink;
    public $infoSegmentId;
    public $volgordeNr;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all infoBloken
    function read(){
          
        // select all query
        $query = 'SELECT
                    `infoBlokId`, `titel`, `inhoud`, `blokFotoUrl`, `meerInfoLink`, `infoSegmentId`, `volgordeNr`, `createdAt`, `isActief`
                FROM
                    `infoblok`
                ORDER BY
                    volgordeNr';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // read infoBloken voor een infoSement
    function readForSegment(){
          
        // select all query
        $query = 'SELECT
                    `infoBlokId`, `titel`, `inhoud`, `blokFotoUrl`, `meerInfoLink`, `infoSegmentId`, `volgordeNr`, `createdAt`, `isActief`
                FROM
                    `infoblok`
                WHERE
                    infoSegmentId= :infoSegmentId
                ORDER BY
                    volgordeNr';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute( [':infoSegmentId' => $this->infoSegmentId] );
        
        return $stmt;
    }


    // get single infoBlok data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `infoBlokId`, `titel`, `inhoud`, `blokFotoUrl`, `meerInfoLink`, `infoSegmentId`, `volgordeNr`, `createdAt`, `isActief`
                FROM
                    `infoblok`
                WHERE
                    infoBlokId= :infoBlokId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute( [':infoBlokId' => $this->infoBlokId] );
        return $stmt;
    }

    // create infoBlok
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO `infoblok`
                        (`titel`, `inhoud`, `blokFotoUrl`, `meerInfoLink`, `infoSegmentId`, `volgordeNr`, `isActief`)
                  VALUES
                        (:titel, :inhoud, :blokFotoUrl, :meerInfoLink, :infoSegmentId, :volgordeNr, :isActief)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute( [':titel' => $this->titel, ':inhoud' => $this->inhoud, ':blokFotoUrl' => $this->blokFotoUrl, ':meerInfoLink' => $this->meerInfoLink, ':infoSegmentId' => $this->infoSegmentId, ':volgordeNr' => $this->volgordeNr, ':isActief' => true] )){
            $this->infoBlokId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update infoBlok 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    `infoblok`
                SET
                    `titel` = :titel, `inhoud` = :inhoud, `blokFotoUrl` = :blokFotoUrl, `meerInfoLink` = :meerInfoLink, `infoSegmentId` = :infoSegmentId
                WHERE
                    `infoBlokId` = :infoBlokId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':titel' => $this->titel, ':inhoud' => $this->inhoud, ':blokFotoUrl' => $this->blokFotoUrl, ':meerInfoLink' => $this->meerInfoLink, ':infoSegmentId' => $this->infoSegmentId, ':infoBlokId' => $this->infoBlokId] )){
            return true;
        }
        return false;
    }

    // update infoBlok volgordeNr
    function updateVolgordeNr(){
    
        // query to insert record
        $query = 'UPDATE
                    `infoblok`
                SET
                    `volgordeNr` = :volgordeNr
                WHERE
                    `infoBlokId` = :infoBlokId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':volgordeNr' => $this->volgordeNr, ':infoBlokId' => $this->infoBlokId] )){
            return true;
        }
        return false;
    }

    // delete infoBlok
    function delete(){
        
        // query to insert record
        $query = "UPDATE
                    `infoblok`
                SET
                    isActief= :isActief
                WHERE
                    infoBlokId= :infoBlokId";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':isActief' => false, ':infoBlokId' => $this->infoBlokId] )){
            return true;
        }
        return false;
    }
}