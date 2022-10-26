<?php
class Nieuwtjes{
 
    // database connection and table name
    private $conn;
    private $table_name = "nieuwtjes";
 
    // object properties
    public $nieuwtjesId;
    public $titel;
    public $korteInhoud;
    public $inhoud;
    public $isActief;
    public $createdAt;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all nieuwtjes
    function read(){
          
        // select all query
        $query = 'SELECT
                    `nieuwtjesId`, `titel`, `korteInhoud`, `inhoud`, `isActief`, `createdAt`
                FROM
                    ' . $this->table_name . ' 
                ORDER BY
                    createdAt DESC';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        
        return $stmt;
    }


    // get single nieuwtjes data
    function read_single(){
    
        // select all query
        $query = 'SELECT
                    `nieuwtjesId`, `titel`, `korteInhoud`, `inhoud`, `isActief`, `createdAt`
                FROM
                    ' . $this->table_name .  ' 
                WHERE
                    nieuwtjesId= "'.$this->nieuwtjesId.'"';
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create nieuwtjes
    function create(){
        
        // query to insert record
        $query = 'INSERT INTO  '. $this->table_name .' 
                        (`titel`,`korteInhoud`, `inhoud`, `isActief`)
                  VALUES
                        ("'.$this->titel.'", "'.$this->korteInhoud.'", "'.$this->inhoud.'",true)';
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->nieuwtjesId = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update nieuwtjes 
    function update(){
    
        // query to insert record
        $query = 'UPDATE
                    '. $this->table_name .'
                SET
                    titel="'.$this->titel.'", korteInhoud="'.$this->korteInhoud.'", inhoud="'.$this->inhoud.'"
                WHERE
                    nieuwtjesId="'.$this->nieuwtjesId.'"';
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete nieuwtjes
    function delete(){
        
        // query to insert record
        $query = "UPDATE
                    ". $this->table_name ."
                SET
                    isActief=false
                WHERE
                    nieuwtjesId='".$this->nieuwtjesId."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}

?>