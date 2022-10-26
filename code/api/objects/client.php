<?php
class Client{
 
    // database connection and table name
    private $conn;
    private $table_name = "client";
 
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
                    ' . $this->table_name . ' 
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
                    ' . $this->table_name . ' 
                WHERE
                    clientId= "'.$this->clientId.'"';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // get single client inlogdate 
    function read_by_email(){
    
        // select all query
        $query = 'SELECT
                    `clientId`, `voornaam`, `achternaam`, `geslacht`, `geboorteDatum`, `wachtwoord`
                FROM
                    ' . $this->table_name . ' 
                WHERE
                    contactGegevensId= "'.$this->contactGegevensId.'"
                AND 
                    isActief = 1';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create client
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .'
                        ( `voornaam`, `achternaam`, `geslacht`, `geboorteDatum`, `contactGegevensId`, `isActief`)
                  VALUES
                        ( "'.$this->voornaam.'", "'.$this->achternaam.'", "'.$this->geslacht.'", "'.$this->geboorteDatum.'", "'.$this->contactGegevensId.'",true)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
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
                    ' . $this->table_name . ' 
                WHERE
                    clientId= "'.$this->clientId.'"
                AND 
                    isActief = 1';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // resetPassword voor client 
    function resetPassword(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    wachtwoord="'.$this->wachtwoord.'"
                WHERE
                    clientId="'.$this->clientId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }


    // update client 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    voornaam="'.$this->voornaam.'", achternaam="'.$this->achternaam.'", geslacht="'.$this->geslacht.'", geboorteDatum="'.$this->geboorteDatum.'", contactGegevensId="'.$this->contactGegevensId.'", tevredenheidsMetingVerstuurd="'.$this->tevredenheidsMetingVerstuurd.'"
                WHERE
                    clientId="'.$this->clientId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete client
    function delete(){
        
        // query to insert record
        $query = "UPDATE
                    ". $this->table_name ."
                SET
                    isActief=false
                WHERE
                    clientId='".$this->clientId."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}