<?php
class Contributor
{
    private $connection;
    private $result;
    
    public function getContributors()
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        mysqli_close($this->connection);
    }
    
    public function sendInvite()
    {
        $to = $_POST['inf'];
        $event = $_POST['event'];
        $etype = $_POST['etype'];
        $semail = $_POST['semail'];
        $subject = $_POST['subject'];
        $greeting = $_POST['greeting'];
        $attach = $_POST['attach'];
        $message = $_POST['message'];
        $esignature = $_POST['esignature'];

        if($_POST)
        {
            mail($to, $event, $etype, $semail, $subject, $greeting, $attach, $message, $esignature);
            $feedback = 'Email has been sent';
        }
    }
}

?>
