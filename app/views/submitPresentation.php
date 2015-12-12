<?php

require '../public/_elements.php';

$pageTitle = 'Submit Presentation';
require '../public/_header.php';
?>

</header>


<div id='content'>
    
    
    <h2><?php echo $pageTitle; ?></h2>
    
    <p>* Required fields.</p>
            
    <form id='presentationSubmission' method='POST' action='index.php?url=home/presentationSubmission'>
                
        <label>Your ID:*</label>
        <input type='text' name='userID'>
                
        <label>Select Event:*</label>
        <select name='selectType'>
        <option value='empty'>Select</option>
        <option value='1'></option>
        <option value='2'></option>
        <option value='3'></option>
        </select>

        <label>Attach Presentation:*</label>
        <input type='file' name='upload'>
     
        <label>Preview:*</label>
       
                
        <input type='submit' value='Submit'/>
        <input type='button' value='Reset' onclick='clearForm()' />
        
    </form>
    
</div>

</body>
</html>