<?php
class AfdelingBegeleiderClient{
 
    // database connection and table name
    private $conn;
    private $table_name = "afdelingBegeleiderClient";
 
    // object properties
    public $afdelingBegeleiderClientId;
    public $afdelingId;
    public $begeleiderId;
    public $clientId;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all afdelingen for a begeleider
    function readAfdelingenForBegeleider(){
          
        // select all query
        $query = 'SELECT
                    `afdelingBegeleiderClientId`, `afdelingId`, `createdAt`
                FROM
                    ' . $this->table_name . '
                WHERE
                    begeleiderId= "'.$this->begeleiderId.'"
                AND afdelingId IS NOT NULL
                ORDER BY
                    afdelingBegeleiderClientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // read all afdelingen for a begeleider
    function readAfdelingenForClient(){
          
        // select all query
        $query = 'SELECT
                    `afdelingBegeleiderClientId`, `afdelingId`, `createdAt`
                FROM
                    ' . $this->table_name . '
                WHERE
                    clientId= "'.$this->clientId.'"
                AND afdelingId IS NOT NULL
                ORDER BY
                    afdelingBegeleiderClientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // read all begeleiders for a afdeling
    function readBegeleidersForAfdeling(){
          
        // select all query
        $query = 'SELECT
                    `afdelingBegeleiderClientId`, `begeleiderId`, `createdAt`
                FROM
                    ' . $this->table_name . '
                WHERE
                    afdelingId= "'.$this->afdelingId.'" 
                    
                AND begeleiderId IS NOT NULL
                ORDER BY
                    afdelingBegeleiderClientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // read all begeleiders for a afdeling
    function readBegeleidersForClient(){
          
        // select all query
        $query = 'SELECT
                    `afdelingBegeleiderClientId`, `begeleiderId`, `createdAt`
                FROM
                    ' . $this->table_name . '
                WHERE
                    clientId= "'.$this->clientId.'" 
                AND begeleiderId IS NOT NULL
                ORDER BY
                    afdelingBegeleiderClientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // create afdelingBegeleider associatie 
    function createBegeleiderAfdeling(){
        
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .'
                        (`afdelingId`, `begeleiderId`,`clientId`)
                  VALUES
                        ("'.$this->afdelingId.'", "'.$this->begeleiderId.'", NULL)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            $this->afdelingBegeleiderClientId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // create afdelingClient associatie 
    function createClientAfdeling(){
    
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .'
                        (`afdelingId`, `begeleiderId`,`clientId`)
                    VALUES
                        ("'.$this->afdelingId.'", NULL, "'.$this->clientId.'")';

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            $this->afdelingBegeleiderClientId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // create begeleiderClient associatie 
    function createClientBegeleider(){
    
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .'
                        (`afdelingId`, `begeleiderId`,`clientId`)
                    VALUES
                        (NULL, "'.$this->begeleiderId.'", "'.$this->clientId.'")';

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            $this->afdelingBegeleiderClientId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update afdelingBegeleiderClient associatie
    function updateBegeleiderAfdeling(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    afdelingId="'.$this->afdelingId.'", begeleiderId="'.$this->begeleiderId.'", clientId=NULL
                WHERE
                    afdelingBegeleiderClientId="'.$this->afdelingBegeleiderClientId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // update afdelingBegeleiderClient associatie
    function updateClientAfdeling(){

        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    afdelingId="'.$this->afdelingId.'", begeleiderId=Null , clientId="'.$this->clientId.'"
                WHERE
                    afdelingBegeleiderClientId="'.$this->afdelingBegeleiderClientId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

     // update afdelingBegeleiderClient associatie
     function updateClientBegeleider(){

        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    afdelingId=Null, begeleiderId="'.$this->begeleiderId.'" , clientId="'.$this->clientId.'"
                WHERE
                    afdelingBegeleiderClientId="'.$this->afdelingBegeleiderClientId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete afdelingBegeleiderClient associatie
    function delete(){
        
        // query to insert record
        $query = 'DELETE FROM
                    ' . $this->table_name . '
                WHERE
                    afdelingBegeleiderClientId= "'.$this->afdelingBegeleiderClientId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}