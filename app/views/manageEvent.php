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
                Type: 
                    <select disabled="disabled">
                        <option value=""><?php echo $data[1][0]["typeDescription"]; ?></option>
                    </select>    
            </div>
            <div>
                Date: <input disabled="disabled" type="date" value="<?php echo date("Y-m-d", strtotime($data[1][0]["date"])); ?>" />
            </div>
            <div>
                Description: <textarea disabled="disabled" rows="4" cols="50"><?php echo $data[1][0]["description"]; ?></textarea>
            </div>
            <div>
                Post Material Link: <input disabled="disabled" type="text" value="<?php echo $data[1][0]["postMaterialLink"]; ?>" />
            </div>
            <div>
                Survey Link: <input disabled="disabled" type="text" value="<?php echo $data[1][0]["surveyLink"]; ?>" disabled="disabled" />
            </div>
        </div>
        <div class="right-col">
            <div>
                Address 1: <input disabled="disabled" type="text" value="<?php echo $data[1][0]["address1"]; ?>" />
            </div>
            <div>
                Address 2: <input disabled="disabled" type="text" value="<?php echo $data[1][0]["address2"]; ?>" />
            </div>
            <div>
                City: <input disabled="disabled" type="text" value="<?php echo $data[1][0]["city"]; ?>" />
            </div>
            <div>
                Post Code: <input disabled="disabled" type="text" value="<?php echo $data[1][0]["postCode"]; ?>" />
            </div>
            <div>
                Total Contributors: <?php echo $data[1][0]["noOfContributors"]; ?>
            </div>
            <div>
                Total Audience Members: <?php echo $data[1][0]["noOfAudienceMembers"]; ?>
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