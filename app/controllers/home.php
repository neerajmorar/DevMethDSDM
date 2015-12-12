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
    
    public function manageEvent($eventID = 1)
    {
        $event = $this->model("Event");
        
        $event->showListOfEvents();
        
        $event->viewEventDetails($eventID);
        
        $this->view("manageEvent", array($event->eventList,$event->events));
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
            //$this->view('setupConfirmation', $eventSetup->events);
        }
    }
    
    //validates submission of the presentation
    public function presentationSubmission()
    {
        
    }
    
  
}