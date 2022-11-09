<?php
class TevredenheidsMeting{
 
    // database connection and table name
    private $conn;
    private $table_name = "tevredenheidsMeting";
 
    // object properties
    public $tevredenheidsMetingId;
    public $formLink;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read first tevredenheidsMeting
    function read_first(){
          
        // select all query
        $query = 'SELECT
                    `tevredenheidsMetingId`, `formLink`, `createdAt`
                FROM
                    tevredenheidsMeting
                LIMIT 1';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    // update tevredenheidsMeting 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    tevredenheidsMeting
                SET
                    formLink=:formLink
                WHERE
                    tevredenheidsMetingId=:tevredenheidsMetingId';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute([':formLink' => $this->formLink, ':tevredenheidsMetingId' => $this->tevredenheidsMetingId])){
            return true;
        }
        return false;
    }
}

?>