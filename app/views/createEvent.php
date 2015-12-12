<?php

require '../public/_elements.php';

$pageTitle = 'Create Event';
require '../public/_header.php';
?>

</header>


<div id='content'>
    
    
    <h2><?php echo $pageTitle; ?></h2>
    
    <p>* Required fields.</p>
            
    <form id='eventSetup' method='POST' action='index.php?url=home/eventSetup'>
                
        <label>Name:*</label>
        <input type='text' name='eventName' placeholder='Event Name' value='<?php if(isset($_POST['eventName'])){ echo $_POST['eventName'];}?>'>
        <p><?php if(isset($errors["eventName"])){ echo $errors["eventName"];}?></p>
                
        <label>Type:*</label>
        <select name='eventType'>
        <option value='empty'>Select</option>
        <option value='1'><?php echo $data[0]['typeDescription']; ?></option>
        <option value='2'><?php echo $data[1]['typeDescription']; ?></option>
        <option value='3'><?php echo $data[2]['typeDescription']; ?></option>
        </select>

        <label>Date:*</label>
        <label>(YYYY-MM-DD)</label>
        <input type='text' name='eventDate' placeholder='Event Date'>
                
        <label>Address 1:*</label>
        <input type='text' name='address1' placeholder='Address'>
                
        <label>Address 2:</label>
        <input type='text' name='address2' placeholder='Address'>
                
        <label>City:*</label>
        <input type='text' name='city' placeholder='City'>
                
        <label>Postcode:*</label>
        <input type='text' name='postcode' placeholder='Postcode'>
                
        <label>Description:*</label>
        <textarea name='description' id='desc' rows='10' cols='50' placeholder='Description'></textarea>
        
  
        <input type='submit' value='Submit'/>
        <input type='button' value='Reset' onclick='clearForm()' />
        <input type='button' value='Save'>
        
    </form>
    
</div>

</body>
</html>