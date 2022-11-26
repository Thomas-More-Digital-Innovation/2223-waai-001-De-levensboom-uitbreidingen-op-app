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
                    afdelingBegeleiderClient 
                WHERE
                    begeleiderId= :begeleiderId
                AND afdelingId IS NOT NULL
                ORDER BY
                    afdelingBegeleiderClientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':begeleiderId' => $this->begeleiderId]);
        
        return $stmt;
    }

    // read all afdelingen for a begeleider
    function readAfdelingenForClient(){
          
        // select all query
        $query = 'SELECT
                    `afdelingBegeleiderClientId`, `afdelingId`, `createdAt`
                FROM
                    afdelingBegeleiderClient
                WHERE
                    clientId= :clientId
                AND afdelingId IS NOT NULL
                ORDER BY
                    afdelingBegeleiderClientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':clientId' => $this->clientId]);
        
        return $stmt;
    }

    // read all begeleiders for a afdeling
    function readBegeleidersForAfdeling(){
          
        // select all query
        $query = 'SELECT
                    `afdelingBegeleiderClientId`, `begeleiderId`, `createdAt`
                FROM
                    afdelingBegeleiderClient
                WHERE
                    afdelingId= :afdelingId
                    
                AND begeleiderId IS NOT NULL
                ORDER BY
                    afdelingBegeleiderClientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':afdelingId' => $this->afdelingId]);
        
        return $stmt;
    }

    // read all begeleiders for a afdeling
    function readBegeleidersForClient(){
          
        // select all query
        $query = 'SELECT
                    `afdelingBegeleiderClientId`, `begeleiderId`, `createdAt`
                FROM
                    afdelingBegeleiderClient
                WHERE
                    clientId= :clientId
                AND begeleiderId IS NOT NULL
                ORDER BY
                    afdelingBegeleiderClientId';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute([':clientId' => $this->clientId]);
        
        return $stmt;
    }

    // create afdelingBegeleider associatie 
    function createBegeleiderAfdeling(){

        // query to insert record
        $query = 'INSERT INTO  afdelingBegeleiderClient
                        (`afdelingId`, `begeleiderId`,`clientId`)
                  VALUES
                        (:afdelingId, :begeleiderId, NULL)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute([':afdelingId' => $this->afdelingId, ':begeleiderId' => $this->begeleiderId])){
            $this->afdelingBegeleiderClientId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // create afdelingClient associatie 
    function createClientAfdeling(){
    
        // query to insert record
        $query = 'INSERT INTO  afdelingBegeleiderClient
                        (`afdelingId`, `begeleiderId`,`clientId`)
                    VALUES
                        (:afdelingId, NULL, :clientId)';

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute([':afdelingId' => $this->afdelingId, ':clientId' => $this->clientId])){
            $this->afdelingBegeleiderClientId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // create begeleiderClient associatie 
    function createClientBegeleider(){
    
        // query to insert record
        $query = 'INSERT INTO  afdelingBegeleiderClient
                        (`afdelingId`, `begeleiderId`,`clientId`)
                    VALUES
                        (NULL, :begeleiderId, :clientId)';

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute([':begeleiderId' => $this->begeleiderId, ':clientId' => $this->clientId])){
            $this->afdelingBegeleiderClientId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update afdelingBegeleiderClient associatie
    function updateBegeleiderAfdeling(){
    
        // query to insert record
        $query = 'UPDATE
                    afdelingBegeleiderClient
                SET
                    afdelingId=:afdelingId, begeleiderId=:begeleiderId, clientId=NULL
                WHERE
                    afdelingBegeleiderClientId=:afdelingBegeleiderClientId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute([':afdelingId' => $this->afdelingId, ':begeleiderId' => $this->begeleiderId, ':afdelingBegeleiderClientId' => $this->afdelingBegeleiderClientId])){
            return true;
        }
        return false;
    }

    // update afdelingBegeleiderClient associatie
    function updateClientAfdeling(){

        // query to insert record
        $query = 'UPDATE
                    afdelingBegeleiderClient
                SET
                    afdelingId=:afdelingId, begeleiderId=Null , clientId=:clientId
                WHERE
                    afdelingBegeleiderClientId=:afdelingBegeleiderClientId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute([':afdelingId' => $this->afdelingId, ':clientId' => $this->clientId, ':afdelingBegeleiderClientId' => $this->afdelingBegeleiderClientId])){
            return true;
        }
        return false;
    }

     // update afdelingBegeleiderClient associatie
     function updateClientBegeleider(){

        // query to insert record
        $query = 'UPDATE
                    afdelingBegeleiderClient
                SET
                    afdelingId=Null, begeleiderId=:begeleiderId , clientId=:clientId
                WHERE
                    afdelingBegeleiderClientId=:afdelingBegeleiderClientId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute([':begeleiderId' => $this->begeleiderId, ':clientId' => $this->clientId, ':afdelingBegeleiderClientId' => $this->afdelingBegeleiderClientId])){
            return true;
        }
        return false;
    }

    // delete afdelingBegeleiderClient associatie
    function delete(){
        
        // query to insert record
        $query = 'DELETE FROM
                    afdelingBegeleiderClient
                WHERE
                    afdelingBegeleiderClientId= :afdelingBegeleiderClientId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute([':afdelingBegeleiderClientId' => $this->afdelingBegeleiderClientId])){
            return true;
        }
        return false;
    }
}