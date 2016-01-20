<?php
session_start();

//child class used to display home page and products for sale
class Home extends Controller 
{
    public function index()
    {
        $this->view("index");
    }
            
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
            ///
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
            $eventSetup->registerEvent($_POST['eventType'], $_POST['eventName'], $_POST['eventDate'], $_POST['address1'], $_POST['address2'], $_POST['city'], $_POST['postcode'], $_POST['description']);
            $this->view('setupConfirmation', $eventSetup->events);
        }
    }
    
    public function submitPresentation()
    {
        $event = $this->model("Event");
        
        $event->getEventTypes();
        
        $this->view('submitPresentation', $event->eventTypes); 
    }
    
    
    public function presentationSub()
    {
        $submissionValidation = true; 
        
        
        //checking if the field is empty 
        if(empty($_POST['userID']))
        { 
          $submissionValidation = false;    
        }
        
        // need validation for event type
       // if (empty($_FILES['upload']['name'])) {
        //    $submissionValidation = false;
       // }
        

        if ($submissionValidation == false) 
        {     
            header('Location:index.php?url=home/submitPresentation');  
            exit();
        }
        else
        {
            $presentation = $this->model('Event');
            $presentation->submitPresentation($_POST['userID'], $_POST['eventType'], $_FILES['upload']);
            $this->view('presentationSubmission', $presentation->events);
        }
        
    }
    
    //redirects to webpage with confirmation of submission 
    public function presentationSubmission()
    {
      $event = $this->model("Event");
        
      $event->getEventTypes();
        
      $this->view('presentationSubmission', $event->eventTypes); 

    }
    
    //handles the submission of abstracts by contributors
    public function submitAbstract($confirmation = null)
    {
        //check if form has been submitted
        if (!empty($_POST["eventID"]) && !empty($_POST["contributorID"]) && !empty($_POST["abstract"]))
        {
            //object of Abstracts class
            $abstract = $this->model("Abstracts");
            
            //validates any attached files
            if (!empty($_FILES["attachment"]) && ($_FILES["attachment"]["error"] == 0))
            {
                //build properties of uploaded file
                $fileName = $_FILES["attachment"]['name'];
                $tmpName  = $_FILES["attachment"]['tmp_name'];
                $fileSize = $_FILES["attachment"]['size'];
                $fileType = $_FILES["attachment"]['type'];

                $ext = strtolower(substr($fileName, strrpos($fileName, '.') + 1));
                $validExt = array("jpg", "png", "docx", "doc", "pdf", "ppt", "pptx");
                
                //check if extension of upload is valid
                if (in_array($ext, $validExt) && $fileSize <= 2000000)
                {
                    //read file
                    $fp = fopen($tmpName, 'r');
                    $content = fread($fp, filesize($tmpName));
                    //$content = addslashes($content);
                    fclose($fp);

                    if(!get_magic_quotes_gpc())
                    {
                        $fileName = addslashes($fileName);
                    }

                    //upload file to database
                    $abstract->insertAbstract($_POST["contributorID"], $_POST["eventID"], $_POST["abstract"], 
                            $content, $fileName, $fileType, $fileSize);
                }
                else
                {
                    //pass paramater c to produce message saying invalid file
                    die(header("location: index.php?url=home/submitAbstract/c"));
                }
            }
            else
            {
                //file not uploaded, but abstract submitted
                $abstract->insertAbstract($_POST["contributorID"], $_POST["eventID"], $_POST["abstract"]);
            }
            
            //return to page passing appropriate confirmation paramater about abstract submission
            die(header("location: index.php?url=home/submitAbstract/" . $abstract->confirmation));
        }
        
        $event = $this->model("Event");
        
        $event->showListOfEvents();
        
        $this->view("submitAbstract", array($event->eventList, $confirmation));
    }
    
    public function test()
    {
        $abstract = $this->model("Abstracts");
        
        $abstract->downloadAbstract();
    }
    
    public function inviteContributors($feedback = null) 
    {
        if (!empty($_POST["event"]) && !empty($_POST["inf"])
                && $_POST["etype"] != 0 && !empty($_POST["semail"]) && !empty($_POST["subject"])
                && !empty($_POST["greeting"]) && !empty($_POST["message"]) && !empty($_POST["esignature"]))
        {
        $contributor = $this->model("Contributor");
        $contributor->sendInvite($_POST["inf"], $_POST["event"], $_POST["etype"], $_POST["semail"],
                    $_POST["subject"], $_POST["greeting"], $_POST["message"], $_POST["esignature"]);
            die(header("location: index.php?url=home/inviteAudience/" . $contributor->feedback));
        }
        
        $event = $this->model("Event");
        $event->showListOfEvents();
        
        $this->view("inviteContributors", array($event->eventList));
    }
    
    
    
    public function inviteAudience($feedback = null)
    {
        if (!empty($_POST["event"]) && !empty($_POST["inf"])
                && $_POST["etype"] != 0 && !empty($_POST["semail"]) && !empty($_POST["subject"])
                && !empty($_POST["greeting"]) && !empty($_POST["message"]) && !empty($_POST["esignature"]))
        {
            $audienceMember = $this->model("AudienceMember");
            $audienceMember->sendInvite($_POST["inf"], $_POST["event"], $_POST["etype"], $_POST["semail"],
                    $_POST["subject"], $_POST["greeting"], $_POST["message"], $_POST["esignature"]);
            die(header("location: index.php?url=home/inviteAudience/" . $audienceMember->feedback));
        }
        
        $event = $this->model("Event");
        $event->showListOfEvents();
        
        $this->view("inviteAudience", array($event->eventList, $feedback));
    }
    
    public function reviewPresentation()
    {
        $eventContributor = $this->model("EventContributor");
        
        $eventContributor->createPresentation();
        
        $this->view("reviewPresentation", $eventContributor->presentationType);
    }
}