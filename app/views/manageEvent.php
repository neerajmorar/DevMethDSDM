<?php
//page relates to the manageEvent method of home controller

//$data[0] contains all the list of events;
//$data[1] contains information on a given event;
//$data[2] contains all the list of event types 

/* READ -- important logic executed by JavaScript at the bottom of this page */

require '../public/_elements.php';

$pageTitle = 'Manage Event';
require '../public/_header.php';

//checks if data exists for specified event id
//if not, redirect to default event id
if (isset($data[1][0]) == false)
{
    header("location: index.php?url=home/manageEvent");
    die();
}
?>

</header>

<div id="content">
    <!-- page driven by a form -->
    <form method="post" id="manageEventForm">
        
        <!-- use a table layout to order form elements side-by-side using CSS -->
        <div class="table-layout" id="formContent">
            <!-- page title as specified above -->
            <h2><?php echo $pageTitle; ?></h2>
            <!-- edit button; used to edit the event - see JavaScript at the bottom of page -->
            <input type="button" id="editEvent" onclick="editForm()" value="Edit"/>

            <p id="reqFields"><strong>* Required fields</strong></p>
            <!-- left column for table layout -->
            <div class="left-col">
                <!-- create rows, each row has a corresponding row in right column -->
                <div class="row-1">
                    <label>Event ID:</label> <span class="plain-text"><?php echo $data[1][0]["eventID"]; ?></span>
                </div>
                <div class="row-2" id="eventName">
                    <label>Name:<strong>*</strong> </label> 

                    <select id="eventID" onchange="reloadPage()">
                        <?php
                            //get list of events and create a HTML dropdown list
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
                    <label>Type:<strong>*</strong> </label>
                        <select disabled="disabled" class="editForm" name="eventType">
                            <?php
                                //create dropdown list of event types
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
                    <label>Date:<strong>*</strong> </label> <input class="editForm" name="eventDate" disabled="disabled" type="date" value="<?php echo date("Y-m-d", strtotime($data[1][0]["date"])); ?>" required />
                </div>
                <div class="row-5">
                    <label>Description:<strong>*</strong> </label> <textarea class="editForm" name="eventDesc" disabled="disabled" rows="10" cols="50" required ><?php echo $data[1][0]["description"]; ?></textarea>
                </div>
                <div class="row-6">
                    <label>Post Material Link:</label> <input class="editForm" name="eventMatLink" disabled="disabled" type="url" value="<?php echo $data[1][0]["postMaterialLink"]; ?>"  />
                </div>
                <div class="row-7">
                    <label>Survey Link:</label> <input disabled="disabled" type="text" value="<?php echo $data[1][0]["surveyLink"]; ?>" disabled="disabled" />
                </div>
            </div>
            <!-- creates a "whitespace" between left and right column -->
            <div class="table-space"></div>
            <!-- right column of table layout -->
            <div class="right-col">
                <!-- create rows, each row has corresponding row in left column -->
                <div class="row-1">
                    <label>Address 1:<strong>*</strong> </label> <input class="editForm" name="eventAdd1" disabled="disabled" type="text" value="<?php echo $data[1][0]["address1"]; ?>" required />
                </div>
                <div class="row-2">
                    <label>Address 2:</label> <input class="editForm" name="eventAdd2" disabled="disabled" type="text" value="<?php echo $data[1][0]["address2"]; ?>" />
                </div>
                <div class="row-3">
                    <label>City:<strong>*</strong></label> <input class="editForm" name="eventCity" disabled="disabled" type="text" value="<?php echo $data[1][0]["city"]; ?>" required />
                </div>
                <div class="row-4">
                    <label>Post Code:<strong>*</strong></label> <input class="editForm" name="eventPostCode" disabled="disabled" type="text" value="<?php echo $data[1][0]["postCode"]; ?>" required />
                </div>
                <div class="row-5">
                    <label>Total Contributors:</label> <span class="plain-text"><?php echo $data[1][0]["noOfContributors"]; ?></span>
                </div>
                <div class="row-6">
                    <label>Total Audience Members:</label> <span class="plain-text"><?php echo $data[1][0]["noOfAudienceMembers"]; ?></span>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $("#manageEventForm").validate();
    
    //variable which indicates the event is being edited
    var editOn = false;
    
    //appends the event id to the end of the url without reloading the page
    history.pushState('', '', "index.php?url=home/manageEvent/<?php echo $data[1][0]["eventID"]; ?>");
    
    //function used to display confirmation boxes to the user
    //to prevent loss of data or changes
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
    
    //function which loads the information of the event selected by the user
    //in "edit off" mode.
    function reloadPage()
    {
        //gets event id value of selected option in select list
        var e = document.getElementById("eventID");
        var eventID = e.options[e.selectedIndex].value;
        
        //refresh the page passing in the event id value as parameter
        window.location.assign((window.location.pathname) + "?url=home/manageEvent/" + eventID);
    }
    
    //function executed when the Edit button is clicked by user;
    //enabled form to be edited.
    function editForm()
    {
        //gets HTML collection of all disabled elements
        var eList = document.getElementsByClassName("editForm");
        var e = document.getElementById("eventID");
        
        //forEach loop to iterate through HTML collection
        //and re-enable disabled elements
        Array.prototype.forEach.call(eList, function(e)
        {
            e.removeAttribute("disabled");
        });
        
        //gets the text value of the select dropdown list
        //in order to create editable text box
        var eventName = e.options[e.selectedIndex].text;
        //create a textbox element
        var textInput = document.createElement("input");
        textInput.setAttribute("type", "text");
        //display the text value
        textInput.setAttribute("value", eventName);
        textInput.setAttribute("name", "eventName");
        textInput.required = true;
        //get the element which will be parent to textbox
        var parentNode = document.getElementById("eventName");
        //remove the select dropdown list and replace it with the textbox
        parentNode.replaceChild(textInput,e);
        
        //changing the edit button into a cancel button
        var editFormButton = document.getElementById("editEvent");
        editFormButton.value = "Cancel";
        editFormButton.setAttribute("onclick","cancelEvent()");
        
        //create a submit button to post changes made by the user
        var submitButton = document.createElement("input");
        submitButton.setAttribute("type", "submit");
        submitButton.setAttribute("value", "Save");
        submitButton.setAttribute("onclick", "saveEvent()");
        //insert button before the table-layout div
        document.getElementById("formContent").insertBefore(submitButton, document.getElementById("reqFields"));
        
        //create delete button
        var deleteButton = document.createElement("input");
        deleteButton.setAttribute("type", "button");
        deleteButton.setAttribute("value", "Delete");
        deleteButton.setAttribute("onclick", "deleteEvent()");
        deleteButton.style.marginLeft = "4px";
        //background color red to give as a sign of warning
        deleteButton.style.backgroundColor = "#AA0000";
        deleteButton.style.color = "#FFF";
        document.getElementById("formContent").insertBefore(deleteButton, document.getElementById("reqFields"));
        
        //edit confirmRefresh function to display message 1
        document.getElementById("body").setAttribute("onbeforeunload","return confirmRefresh(1)");
        
        editOn = true;
    }
    
    //executed by cancel button and basically refreshes the page
    function cancelEvent()
    {
        document.getElementById("body").setAttribute("onbeforeunload","return confirmRefresh()");
        location.reload();
    }
    
    //executed by save button and displays a message asking to confirm changes
    function saveEvent()
    {
        document.getElementById("body").setAttribute("onbeforeunload","return confirmRefresh(1)"); 
    }
    
    //executed by delete button and displays warning message and then redirects to 
    //deleteEvent method of home controller
    function deleteEvent()
    {
        var eventID = <?php echo $data[1][0]["eventID"]; ?>
        
        document.getElementById("body").setAttribute("onbeforeunload","return confirmRefresh(2)");
        
        window.location.assign((window.location.pathname) + "?url=home/deleteEvent/" + eventID);
    }
</script>

</body>
</html>