<?php
class Begeleider{
 
    // database connection and table name
    private $conn;
 
    // object properties
    public $begeleiderId;
    public $voornaam;
    public $achternaam;
    public $functie;
    public $wachtwoord;
    public $contactGegevensId;
    public $isActief;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all begeleiders
    function read(){
          
        // select all query
        $query = 'SELECT
                    `begeleiderId`, `voornaam`, `achternaam`, `functie` , `contactGegevensId`, `isActief`, `createdAt`
                FROM
                    `begeleider` 
                ORDER BY
                    begeleiderId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // get single begeleider data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `begeleiderId`, `voornaam`, `achternaam`, `functie`, `contactGegevensId`, `isActief`, `createdAt`
                FROM
                    `begeleider` 
                WHERE
                    begeleiderId= :begeleiderId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute(['begeleiderId' => $this->begeleiderId]);
        return $stmt;
    }

    // get single begeleider inlogdate 
    function read_by_email(){
    
        // select all query
        $query = 'SELECT
                    `begeleiderId`, `wachtwoord`, `voornaam`, `achternaam`, `functie`
                FROM
                    `begeleider` 
                WHERE
                    contactGegevensId= :contactGegevensId
                AND 
                    isActief = 1';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute(['contactGegevensId' => $this->contactGegevensId]);
        return $stmt;
    }

    // get wachtwoord 
    function getWachtwoord(){
    
        // select all query
        $query = 'SELECT
                    `wachtwoord`
                FROM
                    `begeleider` 
                WHERE
                    begeleiderId= :begeleiderId
                AND 
                    isActief = 1';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute(['begeleiderId' => $this->begeleiderId]);
        return $stmt;
    }

    // create begeleider
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  `begeleider` 
                        ( `voornaam`, `achternaam`, `functie`, `isVerified`, `contactGegevensId`, `isActief`)
                  VALUES
                        (:voornaam , :achternaam, :functie, 0 , :contactGegevensId, 1)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute(['voornaam' => $this->voornaam, 'achternaam' => $this->achternaam, 'functie' => $this->functie, 'contactGegevensId' => $this->contactGegevensId])){
            $this->begeleiderId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update begeleider 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    `begeleider`
                SET
                    voornaam= :voornaam, achternaam= :achternaam, functie= :functie, contactGegevensId= :contactGegevensId
                WHERE
                    begeleiderId= :begeleiderId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute(['voornaam' => $this->voornaam, 'achternaam' => $this->achternaam, 'functie' => $this->functie, 'contactGegevensId' => $this->contactGegevensId, 'begeleiderId' => $this->begeleiderId])){
            return true;
        }
        return false;
    }

    // resetPassword voor begeleider 
    function resetPassword(){
    
        // query to insert record
        $query = 'UPDATE
                    `begeleider`
                SET
                    wachtwoord= :wachtwoord
                WHERE
                    begeleiderId= :begeleiderId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute(['wachtwoord' => $this->wachtwoord, 'begeleiderId' => $this->begeleiderId])){
            return true;
        }
        return false;
    }

    // delete begeleider
    function delete(){
        
        // query to insert record
        $query = 'UPDATE
                    `begeleider`
                SET
                    isActief=false
                WHERE
                    begeleiderId= :begeleiderId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute(['begeleiderId' => $this->begeleiderId])){
            return true;
        }
        return false;
    }
}