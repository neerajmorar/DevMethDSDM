<?php

require '../public/_elements.php';

$pageTitle = 'Manage Event';
require '../public/_header.php';
?>

</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <div class="table-layout">
        <div class="left-col">
            <div>
                Event ID: <?php echo $data[1][0]["eventID"]; ?>
            </div>
            <div>
                Name: 
                
                <select id="eventID" onchange="reloadPage()">
                    <?php 
                        foreach($data[0] as $e)
                        {
                            if ($e["eventID"] == $data[1][0]["eventID"])
                            {
                                echo "<option value='" . $e["eventID"] . "' selected='selected'>" . $e["name"] . "</option>";
                            }
                            else
                            {
                                echo "<option value='" . $e["eventID"] . "'>" . $e["name"] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div>
                Type: <?php echo $data[1][0]["typeDescription"]; ?>
            </div>
            <div>
                Date: <?php echo date("d/m/Y", strtotime($data[1][0]["date"])); ?>
            </div>
            <div>
                Description: <?php echo $data[1][0]["description"]; ?>
            </div>
            <div>
                Post Material Link: <?php echo $data[1][0]["postMaterialLink"]; ?>
            </div>
            <div>
                Survey Link: <?php echo $data[1][0]["surveyLink"]; ?>
            </div>
        </div>
        <div class="right-col">
            <div>
                Address 1: <?php echo $data[1][0]["address1"]; ?>
            </div>
            <div>
                Address 2: <?php echo $data[1][0]["address2"]; ?>
            </div>
            <div>
                City: <?php echo $data[1][0]["city"]; ?>
            </div>
            <div>
                Post Code: <?php echo $data[1][0]["postCode"]; ?>
            </div>
            <div>
                Contributor Number: <?php echo $data[1][0]["noOfContributors"]; ?>
            </div>
            <div>
                Audience Number: <?php echo $data[1][0]["noOfAudienceMembers"]; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function reloadPage()
    {
        var e = document.getElementById("eventID");
        var eventID = e.options[e.selectedIndex].value;
        
        window.location.assign((window.location.pathname) + "?url=home/manageEvent/" + eventID);
    }
</script>

</body>
</html>