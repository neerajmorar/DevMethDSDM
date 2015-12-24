<?php

$pageTitle = 'Submit Abstract';
require '../public/_header.php';
?>

</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <form method="post" enctype="multipart/form-data">
        <input type="submit" value="Submit" />
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <div class="table-layout">
            <div class="left-col">
                <div class="row-1">
                    <label>Select Event:</label>
                    
                    <select name="eventID">
                        <?php
                            foreach($data as $e)
                            {
                                echo "<option value='" . $e["eventID"] . "'>" . $e["name"] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="row-2">
                    <label>Your ID:</label>
                    
                    <input name="contributorID" type="number" min="0" />
                </div>
                <div class="row-3">
                    <label>Your Abstract:</label>
                    
                    <textarea name="abstract" rows="10" cols="50"></textarea>
                </div>
            </div>
            <div class="right-col">
                <div class="row-1">
                    <label>Attachment:</label>

                    <input type="file" name="attachment" />
                </div>
            </div>
        </div>        
    </form>
</div>
