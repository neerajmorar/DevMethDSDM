<?php

require '../public/_elements.php';

$pageTitle = 'Create Event';
require '../public/_header.php';
?>

</header>


<div id='content'>
    <form id='eventSetup' method='POST' action='index.php?url=home/eventSetup'>
        
        
        
        <div class="table-layout">
            <h2><?php echo $pageTitle; ?></h2>
            
            <input type='submit' value='Submit'/>
            <input type='button' value='Reset' onclick='clearForm()' />
    
            <p><strong>* Required fields</strong></p>
            
    
             
            <div class="left-col">
                
                <div class="row-1">
                    <label>Name:*</label>
                    <input type='text' name='eventName' placeholder='Event Name' value='<?php if(isset($_SESSION['eventName'])){ echo $_SESSION['eventName'];}?>'>
                    <p><?php if(isset($errors["eventName"])){ echo $errors["eventName"];}?></p>
                </div>
                
                <div class="row-2">
                    <label>Type:*</label>
                    <select name='eventType'>
                    <option value='empty'>Select</option>
                    <?php
                        //create dropdown list of event types
                        foreach($data as $e)
                        {
                            echo "<option value='" . $e["typeID"] . "'>" . $e["typeDescription"] ."</option>";
                        }
                    ?>
                    </select>
                </div>

                <div class="row-3">
                    <label>Date:*</label>
                    <input type='date' name='eventDate'>
                </div>
                    
                <div class="row-4">
                    <label>Address 1:*</label>
                    <input type='text' name='address1' placeholder='Address'>
                </div>
                    
                <div class="row-5">
                    <label>Address 2:</label>
                    <input type='text' name='address2' placeholder='Address'>
                </div>
                 
                <div class="row-6">
                    <label>City:*</label>
                    <input type='text' name='city' placeholder='City'>
                </div>
            </div>
            <div class="table-space"></div>
            <div class="right-col">
                
                <div class="row-1">
                    <label>Postcode:*</label>
                    <input type='text' name='postcode' placeholder='Postcode'>
                </div>
                
                <div class="row-2">
                    <label>Description:*</label>
                    <textarea name='description' id='desc' rows='10' cols='50' placeholder='Description'></textarea>
                </div>
            </div>
            </div>
        
        
    </form>
    
</div>

</body>
</html>