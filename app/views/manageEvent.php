<?php

require '../public/_elements.php';

$pageTitle = 'Manage Event';
require '../public/_header.php';
?>

</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <form method="post">
        <div class="table-layout">
            <div class="left-col">
                <div class="row-1">
                    <label>Event ID: </label> <span class="plain-text"><?php echo $data[1][0]["eventID"]; ?></span>
                </div>
                <div class="row-2">
                    <label>Name: </label> 

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
                <div class="row-3">
                    <label>Type: </label>
                        <select disabled="disabled">
                            <option value=""><?php echo $data[1][0]["typeDescription"]; ?></option>
                        </select>    
                </div>
                <div class="row-4">
                    <label>Date: </label> <input disabled="disabled" type="date" value="<?php echo date("Y-m-d", strtotime($data[1][0]["date"])); ?>" />
                </div>
                <div class="row-5">
                    <label>Description: </label> <textarea disabled="disabled" rows="4" cols="50"><?php echo $data[1][0]["description"]; ?></textarea>
                </div>
                <div class="row-6">
                    <label>Post Material Link: </label> <input disabled="disabled" type="text" value="<?php echo $data[1][0]["postMaterialLink"]; ?>" />
                </div>
                <div class="row-7">
                    <label>Survey Link: </label> <input disabled="disabled" type="text" value="<?php echo $data[1][0]["surveyLink"]; ?>" disabled="disabled" />
                </div>
            </div>
            <div class="table-space"></div>
            <div class="right-col">
                <div class="right-col-align">
                    <div class="row-1">
                        <label>Address 1: </label> <input disabled="disabled" type="text" value="<?php echo $data[1][0]["address1"]; ?>" />
                    </div>
                    <div class="row-2">
                        <label>Address 2: </label> <input disabled="disabled" type="text" value="<?php echo $data[1][0]["address2"]; ?>" />
                    </div>
                    <div class="row-3">
                        <label>City: </label> <input disabled="disabled" type="text" value="<?php echo $data[1][0]["city"]; ?>" />
                    </div>
                    <div class="row-4">
                        <label>Post Code: </label> <input disabled="disabled" type="text" value="<?php echo $data[1][0]["postCode"]; ?>" />
                    </div>
                    <div class="row-5">
                        <label>Total Contributors: </label> <span class="plain-text"><?php echo $data[1][0]["noOfContributors"]; ?></span>
                    </div>
                    <div class="row-6">
                        <label>Total Audience Members: </label> <span class="plain-text"><?php echo $data[1][0]["noOfAudienceMembers"]; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
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