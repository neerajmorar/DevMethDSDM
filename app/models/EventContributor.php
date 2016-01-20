<?php

class EventContributor
{
    private $connection;
    private $result;
    public $presentation = array();
    public $presentationType;
    
    public function createPresentation()
    {
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        $query = "SELECT presentation, presentationType FROM EventContributor WHERE eventID = 6 and contributorID = 2";
        
        $this->result = mysqli_query($this->connection, $query);
        
        while (($row = mysqli_fetch_assoc($this->result)) != false)
        {
            $this->presentation[] = $row;
        }
        
        unlink("presentation" . $this->presentation[0]["presentationType"]);
        file_put_contents("presentation" . $this->presentation[0]["presentationType"], $this->presentation[0]["presentation"]);
        $this->presentationType = $this->presentation[0]["presentationType"];
        
        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }
}

