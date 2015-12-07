<?php

require '../public/_elements.php';

$pageTitle = 'View Event Details';
require '../public/_header.php';
?>

</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <?php 
        if (isset($data[0]))
        {
            echo $data[0]["name"] . " " . $data[0]["description"]; 
        }
        else 
        {
            echo "This event doesn't exist.";
        }
    ?>
</div>
   
</body>
</html>