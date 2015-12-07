<?php
//retrieves MySQL connection
require '../app/credentials.php';

//model class used to handle data relating to Events
class Event
{
    //attributes taken from class diagram
    /*public $eventID;
    public $type;
    public $name;
    public $date;
    public $description;
    public $noOfContributors;
    public $noOfAudienceMembers;
    public $address1;
    public $address2;
    public $city;
    public $postCode;
    public $postMaterialLink;
    public $surveyLink;*/
    private $connection;
    private $result;
    public $events = array();
    public $eventTypes = array();
    
    //returns details on a given event
    public function viewEventDetails($eventID)
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        $query = "SELECT a.*, b.typeDescription FROM event a INNER JOIN eventtype b ON a.type = b.typeID WHERE a.eventID = $eventID";
        
        $this->result = mysqli_query($this->connection, $query);
        
        while (($row = mysqli_fetch_assoc($this->result)) != false)
        {
            $this->events[] = $row;
        }
        
        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }
    
    public function getEventTypes()
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        $query = 'SELECT * FROM eventType';
        
        $this->result = mysqli_query($this->connection, $query);
        
        while (($row = mysqli_fetch_assoc($this->result)) != false)
        {
            $this->eventTypes[] = $row;
        }
        
        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }
}

