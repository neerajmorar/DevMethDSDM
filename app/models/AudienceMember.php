<?php
//retrieves MySQL connection
//require '../app/credentials.php';

class AudienceMember
{
    private $connection;
    private $result;
    public $feedback;
    
    public function getAudience()
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        mysqli_close($this->connection);
    }
    
    public function sendInvite($to, $event, $etype, $semail, $subject, $greeting, $message, $esignature, $attach = null)
    {
        mail($to, $event, $etype, $semail, $subject, $greeting, $attach, $message, $esignature);
        $this->feedback = 'Email has been sent';
    }
}