<?php

require '../public/_elements.php';

$pageTitle = 'Presentation Submitted';
require '../public/_header.php';


$userID = $_POST['userID'];
$type= $_POST['selectType'] ;
$file = $_FILES['upload']['name'];
?>

</header>

<div id='content'>
    
    
    
    <h2><?php echo $pageTitle; ?></h2>
    
    <h3>Presentation has been successfully submitted.</h3>
    
    <h4>Summary of the submission:</h4>
    
    <div class="table-layout">
        
        <div class="left-col">
            
            <div class="row-1">
                <label>User ID:</label>
                <?php echo $userID;?>
            </div>
            
            <div class="row-2">
                <label>Type:</label>
                <?php echo $type;?>
            </div>

            <div class="row-3">
                <label>File:</label>
                <?php echo $file;?>
            </div>
            
        </div>
        
    </div>
    
</div>

</body>
</html>