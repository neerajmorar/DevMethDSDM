<?php

$pageTitle = 'Submit Abstract';
require '../public/_header.php';
?>

</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <form method="post">
        <div class="table-layout">
            <div class="left-col">
                <div class="row-1">
                    <label>Select Event:</label>
                    
                    <select>
                        <option value="1">Test</option>
                    </select>
                </div>
                <div class="row-2">
                    <label>Your ID:</label>
                    
                    <input type="number" />
                </div>
                <div class="row-3">
                    <label>Your Abstract:</label>
                    
                    <textarea rows="10" cols="50"></textarea>
                </div>
            </div>
            <div class="right-col">
                <div class="row-1">
                    <label>Attachment:</label>

                    <input type="file" />
                </div>
            </div>
        </div>        
    </form>
</div>
