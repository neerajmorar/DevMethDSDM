<?php
require '../public/_elements.php';

$pageTitle = 'Review Presentation';
require '../public/_header.php';
?>
</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <form method="post">
        <input type="button" value="Decline" style="background-color: #AA0000; color: #FFF;" onclick="location.href='index.php?url=home/declinePresentation/<?php echo $data[3] . "/" . $data[4]; ?>'" />
        <input type="button" value="Accept" onclick="location.href='index.php?url=home/acceptPresentation/<?php echo $data[3] . "/" . $data[4]; ?>'" />
        <div class="table-layout">
            <div class="left-col">
                <div class="row-1">
                    <label>Select Event:</label>
                    
                    <select id="eventID" onchange="loadContributors()">
                        <?php 
                            if (!empty($data[0]))
                            {
                                echo "<option value='0'>Please select...</option>";
                                foreach($data[0] as $e)
                                {
                                    if ($data[3] == $e["eventID"])
                                    {
                                        echo "<option selected='selected' value='" . $e["eventID"] . "'>" . $e["name"] . "</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='" . $e["eventID"] . "'>" . $e["name"] . "</option>";
                                    }
                                }
                            }
                            else
                            {
                                echo "<option value'0'>No events found</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="row-2">
                    <label>Select Contributor:</label>
                    
                    <select id="contributorID" onchange="loadPresentation()">
                        <?php
                            if(!empty($data[1]))
                            {
                                echo "<option value='0'>Please select...</option>";
                                foreach($data[1] as $e)
                                {
                                    if ($data[4] == $e["contributorID"])
                                    {
                                        echo "<option selected='selected' value='" . $e["contributorID"] . "'>" . $e["firstName"] . " " . $e["lastName"] . "</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='" . $e["contributorID"] . "'>" . $e["firstName"] . " " . $e["lastName"] . "</option>";
                                    }
                                }
                            }
                            else
                            {
                                echo "<option value='0'>No contributors found</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="table-space"></div>
            <div class="right-col">
                <div class="row-1">
                    <iframe src="http://docs.google.com/gview?url=http://52.30.7.198/public/presentation<?php echo $data[2]; ?>&embedded=true" style="width:100%; height:700px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    function loadContributors()
    {
        //gets event id value of selected option in select list
        var e = document.getElementById("eventID");
        var eventID = e.options[e.selectedIndex].value;
        
        //refresh the page passing in the event id value as parameter
        window.location.assign((window.location.pathname) + "?url=home/reviewPresentation/" + eventID);
    }
    
    function loadPresentation()
    {
        //gets event id value of selected option in select list
        var e = document.getElementById("contributorID");
        var eventID = e.options[e.selectedIndex].value;
        
        //refresh the page passing in the event id value as parameter
        window.location.assign((window.location.pathname) + "?url=home/reviewPresentation/<?php echo $data[3] ?>/" + eventID);
    }
</script>

</body>
</html>