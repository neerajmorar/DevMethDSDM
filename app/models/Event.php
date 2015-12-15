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
    public $address1;
    public $address2;
    public $city;
    public $postCode;
    */
    public $noOfContributors = 0;
    public $noOfAudienceMembers = 0;
    public $postMaterialLink = '';
    public $surveyLink = '';
            
    private $connection;
    private $result;
    public $events = array();
    public $eventTypes = array();
    public $eventList = array();
    
    public function showListOfEvents()
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        $query = "SELECT eventID, name FROM event";
        
        $this->result = mysqli_query($this->connection, $query);
        
        while (($row = mysqli_fetch_assoc($this->result)) != false)
        {
            $this->eventList[] = $row;
        }
        
        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }
    
    public function updateEvent($eventID, $type, $name, $date, $add1, $add2, $city, $postCode, $pml, $desc)
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        $query = "UPDATE event SET type = $type, name = '$name', date = '$date'," .
                "address1 = '$add1', address2 = '$add2', city = '$city', postCode = '$postCode'," .
                "postMaterialLink = '$pml', description = '$desc' WHERE eventID = $eventID";
        
        mysqli_query($this->connection, $query);
        
        mysqli_close($this->connection);
    }
    
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
    
    //derives types of the events from db
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
    
    public function registerEvent($eventName, $eventType, $eventDate, $address1, $address2, $city, $postcode, $description)
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        $query = 'INSERT INTO event ("type", "name", "date", "noOfContributors", "noOfAudienceMembers", "address1", "address2", "city", "postCode", "postMaterialLink", "surveyLink", "description")'
                . 'VALUES("$eventName", "$eventType", "$eventDate", "0", "0", "$address1", "$address2", "$city", "$postcode", " ", " ", "$description")';
        
        $this->result = mysqli_query($this->connection, $query);
        
        while (($row = mysqli_fetch_assoc($this->result)) != false)
        {
            $this->events[] = $row;
        }
        
        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }
}

