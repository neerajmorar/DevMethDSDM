<?php
session_start();

//child class used to display home page and products for sale
class Home extends Controller 
{
    //method for home page
    public function index() 
    {
        $product = $this->model('Product');

        $this->view('vwHome', $product->products);
    }
    
    //handles user search for products
    public function search() 
    {
        $product = $this->model('Product');

        if (empty($_POST["search"])) 
        {
            $this->view('vwHome', $product->products);
        } else 
        {
            $product->searchProduct($_POST["search"]);
            
            $this->view('vwHome', $product->products);
        }
    }
    
    //controller method to handle manage event page
    public function manageEvent($eventID = null)
    {
        //avoiding SQL injection; accepts null parameter
        if (empty($eventID) == false && is_numeric($eventID) == false)
        {
            header("location: index.php?url=home/manageEvent");
            die();
        }

        //instantiate object of model Event
        $event = $this->model("Event");
        
        //check to see if the manageEvent form has been posted
        if (!empty($_POST["eventName"]) && isset($_POST["eventType"]) && !empty($_POST["eventDate"])
                 && !empty($_POST["eventDesc"]) && !empty($_POST["eventAdd1"])
                 && !empty($_POST["eventCity"]) && !empty($_POST["eventPostCode"]))
        {
            //if so, apply changes to database
            $event->updateEvent($eventID, $_POST["eventType"], $_POST["eventName"], $_POST["eventDate"], $_POST["eventAdd1"], 
                    $_POST["eventAdd2"], $_POST["eventCity"], $_POST["eventPostCode"], $_POST["eventMatLink"], $_POST["eventDesc"]);
            
            //refresh the page and clear all $_POST variables
            header("location: index.php?url=home/manageEvent/" . $eventID);
            die();
        }
        
        //generate list of all existing events
        $event->showListOfEvents();
        
        //get event info of specified event
        $event->viewEventDetails($eventID);
        
        //get list of all types of events
        $event->getEventTypes();
        
        //load manageEvent view and pass appropriate data
        $this->view("manageEvent", array($event->eventList,$event->events,$event->eventTypes));
    }
    
    public function deleteEvent($eventID)
    {
        $event = $this->model("Event");
        
        $event->deleteEvent($eventID);
        
        header("location: index.php?url=home/manageEvent");
        die();
    }
    
    //handles event creation
    public function createEvent()
    {
        $event = $this->model("Event");
        
        $event->getEventTypes();
        
        $this->view('createEvent', $event->eventTypes); 
    }
    
    //validates data provided by user
    public function eventSetup()
    {
        $eventValidation = true;
        $errors = array();
        

        //checking if the field is empty 
        if (empty($_POST['eventName']))
        {  
            $errors["eventName"] = "This field cannot be empty!"; 
            $eventValidation = false;    
	}

        // need validation for event type
        if ($_POST['eventType'] == 'empty')
        {
            $eventValidation = false; 
        }

        
        /*
        //validating date of the event
        if (0 === preg_match('/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/', $_POST['eventDate'])) 
        { 
            $eventValidation = false;
	}
        
        //checking if the field is empty 
        if (empty($_POST['address1']))
        {  
            $eventValidation = false; 
	}
         
        //validating city name
        if (0 === preg_match('/^[a-zA-Z]+$/', $_POST['city'])) 
        { 
            $eventValidation = false;
	}
        
        //validating postcode
        if (0 === preg_match('^([a-zA-Z]){1}([0-9][0-9]|[0-9]|[a-zA-Z][0-9][a-zA-Z]|[a-zA-Z][0-9][0-9]|[a-zA-Z][0-9]){1}([ ])([0-9][a-zA-z][a-zA-z]){1}$^', $_POST['postcode'])) 
        { 
            $eventValidation = false;
	}
       
        //checking if the field is empty 
        if (empty($_POST['description']))
        {  
            $eventValidation = false; 
	}
         * 
         */
        
        if ($eventValidation == false) 
        {
            
            header('Location:index.php?url=home/createEvent');  
            exit();
        }
        else
        {
            $eventSetup = $this->model('Event');
            $eventSetup->registerEvent($_POST['eventName'], $_POST['eventType'], $_POST['eventDate'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['postcode'], $_POST['description']);
            $this->view('setupConfirmation', $eventSetup->events);
        }
    }
    
    //validates submission of the presentation
    public function presentationSubmission()
    {
        
    }
    
  
}