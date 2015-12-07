<?php

require '../public/_elements.php';

$pageTitle = 'View Event Details';
require '../public/_header.php';
?>

</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <div class="table-layout">
        <div class="left-col">
            <div>
                Event ID: <?php echo $data[0]["eventID"]; ?>
            </div>
            <div>
                Name: <?php echo $data[0]["name"]; ?>
            </div>
            <div>
                Type: <?php echo $data[0]["typeDescription"]; ?>
            </div>
            <div>
                Date: <?php echo date("d/m/Y", strtotime($data[0]["date"])); ?>
            </div>
            <div>
                Description: <?php echo $data[0]["description"]; ?>
            </div>
            <div>
                Post Material Link: <?php echo $data[0]["postMaterialLink"]; ?>
            </div>
            <div>
                Survey Link: <?php echo $data[0]["surveyLink"]; ?>
            </div>
        </div>
        <div class="right-col">
            <div>
                Address 1: <?php echo $data[0]["address1"]; ?>
            </div>
            <div>
                Address 2: <?php echo $data[0]["address2"]; ?>
            </div>
            <div>
                City: <?php echo $data[0]["city"]; ?>
            </div>
            <div>
                Post Code: <?php echo $data[0]["postCode"]; ?>
            </div>
            <div>
                Contributor Number: <?php echo $data[0]["noOfContributors"]; ?>
            </div>
            <div>
                Audience Number: <?php echo $data[0]["noOfAudienceMembers"]; ?>
            </div>
        </div>
    </div>
</div>
   
</body>
</html>