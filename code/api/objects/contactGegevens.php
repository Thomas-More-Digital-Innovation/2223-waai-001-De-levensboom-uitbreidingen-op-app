<?php
class ContactGegevens{
 
    // database connection and table name
    private $conn;
    private $table_name = "contactGegevens";
 
    // object properties
    public $contactGegevensId;
    public $straat;
    public $huisNr;
    public $woonplaats;
    public $postcode;
    public $telNummer;
    public $email;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all contactgegevens
    function read(){
          
        // select all query
        $query = 'SELECT
                    `contactGegevensId`, `straat`, `huisNr`, `woonplaats`, `postcode`, `telNummer`, `email`, `isActief`, `createdAt`
                FROM
                    `contactGegevens`
                ORDER BY
                    contactGegevensId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // get single contactgegevens data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `contactGegevensId`, `straat`, `huisNr`, `woonplaats`, `postcode`, `telNummer`, `email`, `isActief`, `createdAt`
                FROM
                    `contactGegevens`
                WHERE
                    contactGegevensId= :contactGegevensId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute( [':contactGegevensId' => $this->contactGegevensId] );
        return $stmt;
    }

    // create contactgegevens
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO `contactGegevens`
                        (`straat`, `huisNr`, `woonplaats`, `postcode`, `telNummer`, `email`, `isActief`)
                  VALUES
                        (:straat, :huisNr, :woonplaats, :postcode, :telNummer, :email, :isActief)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute( [':straat' => $this->straat, ':huisNr' => $this->huisNr, ':woonplaats' => $this->woonplaats, ':postcode' => $this->postcode, ':telNummer' => $this->telNummer, ':email' => $this->email, ':isActief' => 1] )){
            $this->contactGegevensId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update contactgegevens 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    `contactGegevens`
                SET
                    `straat` = :straat,
                    `huisNr` = :huisNr,
                    `woonplaats` = :woonplaats,
                    `postcode` = :postcode,
                    `telNummer` = :telNummer,
                    `email` = :email,
                WHERE
                    `contactGegevensId` = :contactGegevensId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':straat' => $this->straat, ':huisNr' => $this->huisNr, ':woonplaats' => $this->woonplaats, ':postcode' => $this->postcode, ':telNummer' => $this->telNummer, ':email' => $this->email, ':contactGegevensId' => $this->contactGegevensId] )){
            return true;
        }
        return false;
    }

    //Contactgegevens inactief maken
    function delete(){
        
        // query to insert record
        $query = 'UPDATE
                    `contactGegevens`       
                SET
                    `isActief` = 0
                WHERE
                    `contactGegevensId` = :contactGegevensId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':contactGegevensId' => $this->contactGegevensId] )){
            return true;
        }
        return false;
    }

    // delete contactgegevens
    function hardDelete(){
        
        // query to insert record
        $query = 'DELETE FROM
                    `contactGegevens`       
                WHERE
                    `contactGegevensId` = :contactGegevensId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute( [':contactGegevensId' => $this->contactGegevensId] )){
            return true;
        }
        return false;
    }
}