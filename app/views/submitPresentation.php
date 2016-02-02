<?php

require '../public/_elements.php';

$pageTitle = 'Submit Presentation';
require '../public/_header.php';
?>

</header>


<div id='content'>
            
    <form id='presentationSub' method='POST' action='index.php?url=home/presentationSubmission'>
            
        <div class="table-layout">
            <h2><?php echo $pageTitle; ?></h2>
                
            <input type='submit' value='Submit'/>
            <input type='button' value='Reset' onclick='clearForm()' />
            <p><strong>* Required fields</strong></p>
            <div class="left-col">
                <div class="row-1">
                    <label>Your ID:*</label>
                    <input type='text' name='userID'>
                </div>

                <div class="row-2">
                    <label>Select Event:*</label>
                    <select name='eventType'>
                        <?php
                            foreach($data as $e)
                            {
                                if ($e["typeDescription"] == $data["typeDescription"])
                                {
                                    echo "<option value='" . $e["typeDescription"] . "' selected='selected'>". "</option>";
                                }
                                else
                                {
                                    echo "<option value='" . $e["typeDescription"] . "'>" . $e["typeDescription"] . "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>

                <div class="row-3">
                    <label>Attach Presentation:*</label>
                    <input type='file' name='upload' onchange="loadFile(event)">
                </div>
                
                <div class="row-4">
                    <label>Preview:</label>
                    <img id="output"/>
                </div>    
            
            
            
            
            </div>
        </div>
    </form>
    
</div>
<script type="text/javascript">
   var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>

</body>
</html>