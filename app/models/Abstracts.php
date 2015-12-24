<?php
//retrieves MySQL connection
require_once '../app/credentials.php';

//model class used to handle data relating to Abstract
//plural because Abstract is a PHP keyword
class Abstracts
{
    private $connection;
    private $result;
    public $confirmation;
    
    public function insertAbstract($contributorID, $eventID, $abstract, $attachment = null, $name = null, $type = null, $size = null)
    {
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        $query = $this->connection->prepare("CALL sp_PopulateAbstract(?,?,?)");
        $query->bind_param("iis", $contributorID, $eventID, $abstract);
        
        $query->execute();
        
        $query->bind_result($abID);
        
        while ($query->fetch())
        {
            $abstractID = $abID;
        }
        
        $query->close();
        
        
        if (!empty($attachment))
        {
            $query = $this->connection->prepare("CALL sp_PopulateAbstractAttachments(?,?,?,?,?)");
            $query->bind_param("isssi", $abstractID, $attachment, $name, $type, $size) or die(mysqli_error($this->connection));

            $query->execute() or die(mysqli_error($this->connection));
            
            $query->close();
        }
        
        mysqli_close($this->connection);
    }
    
    public function downloadAbstract()
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        $query = "SELECT name, type, size, attachment FROM AbstractAttachments WHERE attachmentID = 42";
        
        $this->result = mysqli_query($this->connection, $query);
        list($name, $type, $size, $attachment) = mysqli_fetch_array($this->result);
        
        header("Content-length: $size");
        header("Content-type: $type");
        header("Content-Disposition: attachment; filename=$name");
        echo $attachment;
        
        mysqli_close($this->connection);
        exit;
    }
}