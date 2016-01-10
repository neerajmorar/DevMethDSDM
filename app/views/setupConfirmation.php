<?php

require '../public/_elements.php';

$pageTitle = 'Event Created';
require '../public/_header.php';


$eventName = $_POST['eventName'];
$eventType = $_POST['eventType'];
$eventDate = $_POST['eventDate'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$description = $_POST['description'];
?>

</header>

<div id='content'>
    
    <h2><?php echo $pageTitle; ?></h2>
    
    <h3>Event has been successfully created.</h3>
    
    <h4>Summary of the event:</h4>
    
    <div class="table-layout">
        
        <div class="left-col">
            
            <div class="row-1">
                <label>Name:</label>
                <?php echo $eventName;?>
            </div>
            
            <div class="row-2">
                <label>Type:</label>
                <?php echo $eventType;?>
            </div>

            <div class="row-3">
                <label>Date:</label>
                <?php echo $eventDate;?>
            </div>
            
            <div class="row-4">
                <label>Address:</label>
                <?php echo $address1;?>
            </div>
            
            <div class="row-5">
                <label>Address:</label>
                <?php echo $address2;?>
            </div>
            
            <div class="row-6">
                <label>City:</label>
                <?php echo $city;?>
            </div>
            
            <div class="row-7">
                <label>Postcode:</label>
                <?php echo $postcode;?>
            </div>
            
            <div class="row-8">
                <label>Description:</label>
                <?php echo $description;?>
            </div>
            
        </div>
        
    </div>
    
</div>

</body>
</html>