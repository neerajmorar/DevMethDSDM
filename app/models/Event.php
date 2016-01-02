<?php
//retrieves MySQL connection
//require '../app/credentials.php';

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
        
        //updates row of specified event id
        //prepared statement to prevent SQL injection
        $query = $this->connection->prepare("UPDATE event "
                . "SET type = ?, name = ?, date = ?, address1 = ?, address2 = NULLIF(?,''), city = ?, postCode = ?, postMaterialLink = NULLIF(?,''), description = ? "
                . "WHERE eventID = ?") or die(mysqli_error($this->connection));
        $query->bind_param("issssssssi", $type, $name, $date, $add1, $add2, $city, $postCode, $pml, $desc, $eventID);
        
        $query->execute();
        
        $query->close();
        mysqli_close($this->connection);
    }
    
    public function deleteEvent($eventID)
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        //deletes row from event table with given event id
        //prepared statement to prevent SQL injection
        $query = $this->connection->prepare("DELETE FROM event WHERE eventID = ?");
        $query->bind_param("i", $eventID);
        
        $query->execute();
        
        $query->close();
        mysqli_close($this->connection);
    }
    
    //returns details on a given event; mainly drives the manage event page
    public function viewEventDetails($eventID)
    {
        //instantiates connection object from credentials.php
        $conn = new Credentials;
        $this->connection = $conn->conn;
        
        //if $eventID is null, it will display data of the first row
        //that exists in event table
        if (empty($eventID))
        {
            $query = "SELECT MIN(eventID) as eventID FROM event";
            $this->result = mysqli_query($this->connection, $query);
            
            while (($row = mysqli_fetch_assoc($this->result)) != false)
            {
                $ids[] = $row;
            }
            
            //if no event exists in event table, it will redirect to creat event page
            $eventID = $ids[0]["eventID"] or die(header("location: index.php?url=home/createEvent"));
            
            mysqli_free_result($this->result);
        }
        
        //gets all the info related to provided event id
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
        
        $query = 'INSERT INTO event (type, name, date, noOfContributors, noOfAudienceMembers, address1, address2, city, postCode, postMaterialLink, surveyLink, description)'
                . 'VALUES("$eventName", "$eventType", "$eventDate", "$noOfContributors", "$noOfAudienceMembers", "$address1", "$address2", "$city", "$postcode", " ", " ", "$description")';
        
        $this->result = mysqli_query($this->connection, $query);
        
        while (($row = mysqli_fetch_assoc($this->result)) != false)
        {
            $this->events[] = $row;
        }
        
        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }
    
    public function viewEventConfirmation()
    {
        
    }
}

