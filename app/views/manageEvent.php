<?php

require '../public/_elements.php';

$pageTitle = 'Manage Event';
require '../public/_header.php';
?>

</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>    
    
    <form method="post" id="manageEventForm">
        <input type="button" id="editEvent" onclick="editForm()" value="Edit"/>
        
        <div class="table-layout" id="formContent">
            <div class="left-col">
                <div class="row-1">
                    <label>Event ID: </label> <span class="plain-text"><?php echo $data[1][0]["eventID"]; ?></span>
                </div>
                <div class="row-2" id="eventName">
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
                        <select disabled="disabled" class="editForm" name="eventType">
                            <?php
                                foreach($data[2] as $e)
                                {
                                    if ($e["typeID"] == $data[1][0]["type"])
                                    {
                                        echo "<option value='" . $e["typeID"] . "' selected='selected'>" . $e["typeDescription"] ."</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='" . $e["typeID"] . "'>" . $e["typeDescription"] ."</option>";
                                    }
                                }
                            ?>
                        </select>    
                </div>
                <div class="row-4">
                    <label>Date: </label> <input class="editForm" name="eventDate" disabled="disabled" type="date" value="<?php echo date("Y-m-d", strtotime($data[1][0]["date"])); ?>" />
                </div>
                <div class="row-5">
                    <label>Description: </label> <textarea class="editForm" name="eventDesc" disabled="disabled" rows="10" cols="50"><?php echo $data[1][0]["description"]; ?></textarea>
                </div>
                <div class="row-6">
                    <label>Post Material Link: </label> <input class="editForm" name="eventMatLink" disabled="disabled" type="text" value="<?php echo $data[1][0]["postMaterialLink"]; ?>" />
                </div>
                <div class="row-7">
                    <label>Survey Link: </label> <input disabled="disabled" type="text" value="<?php echo $data[1][0]["surveyLink"]; ?>" disabled="disabled" />
                </div>
            </div>
            <div class="table-space"></div>
            <div class="right-col">
                <div class="right-col-align">
                    <div class="row-1">
                        <label>Address 1: </label> <input class="editForm" name="eventAdd1" disabled="disabled" type="text" value="<?php echo $data[1][0]["address1"]; ?>" />
                    </div>
                    <div class="row-2">
                        <label>Address 2: </label> <input class="editForm" name="eventAdd2" disabled="disabled" type="text" value="<?php echo $data[1][0]["address2"]; ?>" />
                    </div>
                    <div class="row-3">
                        <label>City: </label> <input class="editForm" name="eventCity" disabled="disabled" type="text" value="<?php echo $data[1][0]["city"]; ?>" />
                    </div>
                    <div class="row-4">
                        <label>Post Code: </label> <input class="editForm" name="eventPostCode" disabled="disabled" type="text" value="<?php echo $data[1][0]["postCode"]; ?>" />
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
    var editOn = false;
    
    function confirmRefresh(submit)
    {
        if (editOn === true && submit === 1)
        {
            return "Are you sure you want to make these changes? You won't be able to revert them after.";
        }
        else if (editOn === true && submit === 2)
        {
            return "WARNING! You are about to delete this event. Do you want to continue?";
        }
        else if (editOn === true)
        {
            return "Any changes you have made will be lost; are you sure you want to continue?";
        }
    }
    
    function reloadPage()
    {
        var e = document.getElementById("eventID");
        var eventID = e.options[e.selectedIndex].value;
        
        window.location.assign((window.location.pathname) + "?url=home/manageEvent/" + eventID);
    }
    
    function editForm()
    {
        var eList = document.getElementsByClassName("editForm");
        var e = document.getElementById("eventID");
        
        Array.prototype.forEach.call(eList, function(e)
        {
            e.removeAttribute("disabled");
        });
        
        var eventName = e.options[e.selectedIndex].text;
        var textInput = document.createElement("input");
        
        textInput.setAttribute("type", "text");
        textInput.setAttribute("value", eventName);
        textInput.setAttribute("name", "eventName");
        var parentNode = document.getElementById("eventName");
        parentNode.replaceChild(textInput,e);
        
        var editFormButton = document.getElementById("editEvent");
        editFormButton.value = "Cancel";
        editFormButton.setAttribute("onclick","cancelEvent()");
        
        var submitButton = document.createElement("input");
        submitButton.setAttribute("type", "submit");
        submitButton.setAttribute("value", "Save");
        submitButton.setAttribute("onclick", "saveEvent()");
        document.getElementById("manageEventForm").insertBefore(submitButton, document.getElementById("formContent"));
        
        var deleteButton = document.createElement("input");
        deleteButton.setAttribute("type", "button");
        deleteButton.setAttribute("value", "Delete");
        deleteButton.setAttribute("onclick", "deleteEvent()");
        deleteButton.style.marginLeft = "4px";
        document.getElementById("manageEventForm").insertBefore(deleteButton, document.getElementById("formContent"));
        
        document.getElementById("body").setAttribute("onbeforeunload","return confirmRefresh(1)");
        
        editOn = true;
    }
    
    function cancelEvent()
    {
        document.getElementById("body").setAttribute("onbeforeunload","return confirmRefresh()");
        location.reload();
    }
    
    function saveEvent()
    {
       document.getElementById("body").setAttribute("onbeforeunload","return confirmRefresh(1)"); 
    }
    
    function deleteEvent()
    {
        var eventID = <?php echo $data[1][0]["eventID"]; ?>
        
        document.getElementById("body").setAttribute("onbeforeunload","return confirmRefresh(2)");
        
        window.location.assign((window.location.pathname) + "?url=home/deleteEvent/" + eventID);
    }
</script>

</body>
</html>