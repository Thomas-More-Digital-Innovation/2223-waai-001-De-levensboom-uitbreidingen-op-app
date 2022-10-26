<?php
class Begeleider{
 
    // database connection and table name
    private $conn;
    private $table_name = "begeleider";
 
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
                    ' . $this->table_name . ' 
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
                    ' . $this->table_name . ' 
                WHERE
                    begeleiderId= "'.$this->begeleiderId.'"';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // get single begeleider inlogdate 
    function read_by_email(){
    
        // select all query
        $query = 'SELECT
                    `begeleiderId`, `wachtwoord`, `voornaam`, `achternaam`, `functie`
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

    // get wachtwoord 
    function getWachtwoord(){
    
        // select all query
        $query = 'SELECT
                    `wachtwoord`
                FROM
                    ' . $this->table_name . ' 
                WHERE
                    begeleiderId= "'.$this->begeleiderId.'"
                AND 
                    isActief = 1';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create begeleider
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .' 
                        ( `voornaam`, `achternaam`, `functie`, `isVerified`, `contactGegevensId`, `isActief`)
                  VALUES
                        ("'.$this->voornaam.'", "'.$this->achternaam.'", "'.$this->functie.'", false , "'.$this->contactGegevensId.'", true)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->begeleiderId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update begeleider 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    voornaam="'.$this->voornaam.'", achternaam="'.$this->achternaam.'", functie="'.$this->functie.'", contactGegevensId="'.$this->contactGegevensId.'"
                WHERE
                    begeleiderId="'.$this->begeleiderId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // resetPassword voor begeleider 
    function resetPassword(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    wachtwoord="'.$this->wachtwoord.'"
                WHERE
                    begeleiderId="'.$this->begeleiderId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete begeleider
    function delete(){
        
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    isActief=false
                WHERE
                    begeleiderId="'.$this->begeleiderId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}