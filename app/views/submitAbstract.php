<?php

$pageTitle = 'Submit Abstract';
require '../public/_header.php';
?>

</header>

<div id="content">
    <form method="post" enctype="multipart/form-data" id="submitAbstractForm" onsubmit="return formSubmission()" >
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <div class="table-layout">
            <h2><?php echo $pageTitle; ?></h2>
            
            <input type="submit" value="Submit" />
            <p id="reqFields"><strong>* Required fields</strong></p>
            
            <div class="left-col">
                <div class="row-1">
                    <label>Select Event:<strong>*</strong></label>
                    
                    <select name="eventID">
                        <?php
                            foreach($data[0] as $e)
                            {
                                echo "<option value='" . $e["eventID"] . "'>" . $e["name"] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="row-2">
                    <label>Your ID:<strong>*</strong></label>
                    
                    <input name="contributorID" type="number" min="1" required />
                </div>
                <div class="row-3">
                    <label>Your Abstract (Max 500 Words: <span id="wordCount">0</span>):<strong>*</strong> </label> 
                    
                    
                    <textarea name="abstract" rows="10" cols="50" required ></textarea>
                </div>
            </div>
            <div class="right-col">
                <div class="row-1">
                    <label>Attachment:</label>

                    <input type="file" name="attachment" />
                </div>
                <div class="row-2">
                    <p><strong>Valid file types .jpg, .png, .pdf, .docx, .doc, .ppt, .pptx (Max: 2MB)</strong></p>
                </div>
            </div>
        </div>        
    </form>
</div>

<script type="text/javascript">
    $("#submitAbstractForm").validate();
    
    history.pushState('', '', "index.php?url=home/submitAbstract/");
    
    var confirmType = "<?php echo $data[1]; ?>";
        
    if (confirmType === "a")
    {
        window.alert("Your abstract submission was successful!");
    }
    else if (confirmType === "b")
    {
        window.alert("Abstract submission failed.");
    }
    else if (confirmType === "c")
    {
        window.alert("Abstract submission failed; invalid file uploaded.");
    }
    
    function wordCount(val)
    {
        return {
            charactersNoSpaces : val.replace(/\s+/g, '').length,
            characters         : val.length,    
            words              : val.match(/\S+/g).length,
            lines              : val.split(/\r*\n/).length
        };
    }
    
    $("textarea").on("input", function()
    {
        var c = wordCount(this.value);
        
        $("#wordCount").html(c.words);
        
        if (c.words > 500)
        {
            window.alert("Your abstract is over 500 words, please shorten it!");
            valid = false;
        }
        else
        {
            valid = true;
        }
    });
    
    function formSubmission()
    {
        return valid;
    }
</script>

</body>
</html>
