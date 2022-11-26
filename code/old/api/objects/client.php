<?php
class Client{
    // database connection and table name
    private $conn;
 
    // object properties
    public $clientId;
    public $voornaam;
    public $achternaam;
    public $geslacht;
    public $geboorteDatum;
    public $wachtwoord;
    public $contactGegevensId;
    public $isActief;
    public $tevredenheidsMetingVerstuurd;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all clienten
    function read(){
          
        // select all query
        $query = 'SELECT
                    `clientId`, `voornaam`, `achternaam`, `geslacht`, `geboorteDatum`, `contactGegevensId`, `isActief`, `createdAt`
                FROM
                    `client`
                ORDER BY
                    clientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // get single client data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `clientId`, `voornaam`, `achternaam`, `geslacht`, `geboorteDatum`, `contactGegevensId`, `isActief`, `tevredenheidsMetingVerstuurd`, `createdAt`
                FROM
                    `client`
                WHERE
                    clientId= :clientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':clientId' => $this->clientId]);
        return $stmt;
    }

    // get single client inlogdate 
    function read_by_email(){
    
        // select all query
        $query = 'SELECT
                    `clientId`, `voornaam`, `achternaam`, `geslacht`, `geboorteDatum`, `wachtwoord`
                FROM
                    `client`
                WHERE
                    contactGegevensId= :contactGegevensId
                AND 
                    isActief = :isActief';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':contactGegevensId' => $this->contactGegevensId, ':isActief' => 1]);
        return $stmt;
    }

    // create client
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO `client`
                        ( `voornaam`, `achternaam`, `geslacht`, `geboorteDatum`, `contactGegevensId`, `isActief`)
                  VALUES
                        ( :voornaam, :achternaam, :geslacht, :geboorteDatum, :contactGegevensId, :isActief)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute([':voornaam' => $this->voornaam, ':achternaam' => $this->achternaam, ':geslacht' => $this->geslacht, ':geboorteDatum' => $this->geboorteDatum, ':contactGegevensId' => $this->contactGegevensId, ':isActief' => true ] )){
            $this->clientId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // get wachtwoord 
    function getWachtwoord(){
    
        // select all query
        $query = 'SELECT
                    `wachtwoord`
                FROM
                    `client`
                WHERE
                    clientId= :clientId;
                AND 
                    isActief = :isActief';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':clientId' => $this->clientId, ':isActief' => 1]);
        return $stmt;
    }

    // resetPassword voor client 
    function resetPassword(){
    
        // query to insert record
        $query = 'UPDATE
                    `client`
                SET
                    `wachtwoord` = :wachtwoord
                WHERE
                    clientId= :clientId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':wachtwoord' => $this->wachtwoord, ':clientId' => $this->clientId] )){
            return true;
        }
        return false;
    }


    // update client 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    `client`
                SET
                    `voornaam` = :voornaam,
                    `achternaam` = :achternaam,
                    `geslacht` = :geslacht,
                    `geboorteDatum` = :geboorteDatum,
                    `contactGegevensId` = :contactGegevensId,
                    `tevredenheidsMetingVerstuurd` = :tevredenheidsMetingVerstuurd
                WHERE
                    clientId= :clientId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':voornaam' => $this->voornaam, ':achternaam' => $this->achternaam, ':geslacht' => $this->geslacht, ':geboorteDatum' => $this->geboorteDatum, ':contactGegevensId' => $this->contactGegevensId, ':tevredenheidsMetingVerstuurd' => $this->tevredenheidsMetingVerstuurd, ':clientId' => $this->clientId] )){
            return true;
        }
        return false;
    }

    // delete client
    function delete(){
        // query to insert record
        $query = "UPDATE
                    `client`
                SET
                    `isActief` = :isActief
                WHERE
                    clientId= :clientId";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute( [':isActief' => false, ':clientId' => $this->clientId] )){
            return true;
        }
        return false;
    }
}