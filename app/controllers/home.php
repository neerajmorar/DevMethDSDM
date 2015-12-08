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
    
    public function createEvent()
    {
        $event = $this->model("Event");
        
        $event->getEventTypes();
        
        $this->view('createEvent', $event->eventTypes); 
    }
    
     
}
