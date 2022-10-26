<?php
class InfoBlok{
 
    // database connection and table name
    private $conn;
    private $table_name = "infoBlok";
 
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
                    ' . $this->table_name . ' 
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
                    ' . $this->table_name . ' 
                WHERE 
                    infoSegmentId = ' . $this->infoSegmentId . '
                ORDER BY
                    volgordeNr';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }


    // get single infoBlok data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `infoBlokId`, `titel`, `inhoud`, `blokFotoUrl`, `meerInfoLink`, `infoSegmentId`, `volgordeNr`, `createdAt`, `isActief`
                FROM
                    ' . $this->table_name .  ' 
                WHERE
                    infoBlokId= "'.$this->infoBlokId.'"';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create infoBlok
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .' 
                        (`titel`, `inhoud`, `blokFotoUrl`, `meerInfoLink`, `infoSegmentId`, `volgordeNr`, `isActief`)
                  VALUES
                        ("'.$this->titel.'", "'.$this->inhoud.'", "'.$this->blokFotoUrl.'", "'.$this->meerInfoLink.'", "'.$this->infoSegmentId.'", "'.$this->volgordeNr.'", true)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->infoBlokId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update infoBlok 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    titel="'.$this->titel.'", inhoud="'.$this->inhoud.'", blokFotoUrl="'.$this->blokFotoUrl.'", meerInfoLink="'.$this->meerInfoLink.'", infoSegmentId="'.$this->infoSegmentId.'"
                WHERE
                    infoBlokId="'.$this->infoBlokId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // update infoBlok volgordeNr
    function updateVolgordeNr(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    volgordeNr="'.$this->volgordeNr.'"
                WHERE
                    infoBlokId="'.$this->infoBlokId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete infoBlok
    function delete(){
        
        // query to insert record
        $query = "UPDATE
                    ". $this->table_name ."
                SET
                    isActief=false
                WHERE
                    infoBlokId='".$this->infoBlokId."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}