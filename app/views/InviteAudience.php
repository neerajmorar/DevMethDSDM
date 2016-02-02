<?php
$pageTitle = 'Invite Audience';
require '../public/_header.php';
?>

</header>

<div id="content">
    <form id="myForm" name="myForm" onsubmit=" method="POST" action="form_script.php" >
			
        
		<div class="table-layout">
                    <h2><?php echo $pageTitle; ?></h2>
                    <p id="feedback"><?php echo $feedback; ?></p>
                    
                    <input type='reset' value='Clear Form' />
                    <input type='submit' value='Send Email' onclick="return validate();" />
                    <br />
                    <br />
                    
                    <div class="left-col">
                        <div class="row-1">
                            <label>Event Title:</label>
                            <select name="event" id="event"> 
					<option value="0">Please Select</option>
					<?php 
                                            foreach($data[0] as $e)
                                            {
                                                echo "<option value='" . $e["eventID"] . "'>" . $e["name"] . "</option>";
                                            }
                                        ?>
                            </select>
                            <span id="errevent" class="error">This is required</span>
                        </div>
                        <div class="row-2">
                            <label>Enter Audience Email:</label>
                            <input name="aemail" type="email" multiple id="aemail" />
                            <input type='button' value='ADD' style='width: 60px; padding: 0px;' onclick='add()' />
                        </div>
                        <div class='row-3'>
                            <label>Selected Audience:</label>
                            <TEXTAREA rows="10" cols="40" name="inf" id="inf" readonly></TEXTAREA>
                            <span id="errinf" class="error">This is required</span>
                        </div>
                        <div class="row-4">
                            <label>Email Type:</label>
                            <select name="etype" id="etype"  onChange="">
					<option value="0">Please Select</option>
					<option value="1">Invitation</option>
					<option value="2">Attendance Confirmation</option>
                            </select>
                            <span id="erretype" class="error">This is required</span>
                        </div>
                        <div class="row-5">
                            <label>Sender's Email:</label>
                            <input type="email" name="semail" id="semail">
                            <span id="errsemail" class="error">This is required</span>
                        </div>
                        <div class='row-6'>
                            <label>Attachment:</label>
                            <input type="file" multiple name="attach" id="attach" />
                        </div>
                    </div>
                    <div class="right-col">
                        <div class='row-1'>
                            <label>Subject:</label>
                            <input type="text" name="subject" id="subject">
                            <span id="errsubject" class="error">This is required</span>
                        </div>
                        <div class='row-2'>
                            <label>Greeting:</label>
                            <input type="text" name="greeting" id="greeting" />
                            <span id="errgreeting" class="error">This is required</span>
                        </div>
                        <div class='row-3'>
                            <label>Message:</label>
                            <textarea rows="10" cols="80" name="message" id="message"></textarea>
                            <span id="errmessage" class="error">This is required</span>
                        </div>
                        <div class='row-4'>
                            <label>Email Signature:</label>
                            <textarea rows='10' cols='50' name="esignature" id="esignature" ></textarea>
                            <span id="errsig" class="error">This is required</span>
                        </div>
                    </div>
                </div>
				
                

    </form>
</div>

<script type='text/javascript'>
    
   function add() { 
	var aemail;
	var userinfo="";
	userinfo += document.getElementById('aemail').value +"\n"; 
	document.getElementById('inf').value= userinfo;
	return inf;
}


function validate(){
	
	var error = 0;
	
	var errevent = document.getElementById("errevent");
	var event = document.myForm.event.value;
	if(event == 0)
	{
		errevent.style.visibility = "visible";
		document.getElementById('event').style.borderColor = "red";
		error = 1;
	}else {
		errevent.style.visibility = "hidden";
		error = 0;
	}
	
	var errinf = document.getElementById("errinf");
	var inf = document.myForm.inf;
	if(inf.value === "")
	{
		errinf.setAttribute("style","visibility:visible");
		document.getElementById('inf').style.borderColor = "red";
		error = 1;
	}
	else {
		errinf.setAttribute("style","visibility:hidden");
		error = 0;
	}
	
	var erretype = document.getElementById("erretype");
	var etype = document.myForm.etype.value;
	if(etype == 0)
	{
		erretype.style.visibility = "visible";
		document.getElementById('etype').style.borderColor = "red";
		error = 1;
	}
	else {
		erretype.style.visibility = "hidden";
		error = 0;
	}
	
	var errsemail = document.getElementById("errsemail");
	var semail = document.myForm.semail;
	if(semail.value === "")
	{
		errsemail.setAttribute("style","visibility:visible");
		document.getElementById('semail').style.borderColor = "red";
		error = 1;
	}
	else {
		errsemail.setAttribute("style","visibility:hidden");
		error = 0;
	}
	
	var errsubject = document.getElementById("errsubject");
	var subject = document.myForm.subject;
	if(subject.value === "")
	{
		errsubject.setAttribute("style","visibility:visible");
		document.getElementById('subject').style.borderColor = "red";
		error = 1;
	}
	else {
		errsubject.setAttribute("style","visibility:hidden");
		error = 0;
	}
	
	var errgreeting  = document.getElementById("errgreeting");
	var greeting = document.myForm.greeting;
	if(greeting.value === "")
	{
		errgreeting.setAttribute("style","visibility:visible");
		document.getElementById('greeting').style.borderColor = "red";
		error = 1;
	}
	else {
		errgreeting.setAttribute("style","visibility:hidden");
		error = 0;
	}
	
	var errmessage  = document.getElementById("errmessage");
	var message = document.myForm.message;
	if(message.value === "")
	{
		errmessage.setAttribute("style","visibility:visible");
		document.getElementById('message').style.borderColor = "red";
		error = 1;
	}
	else {
		errmessage.setAttribute("style","visibility:hidden");
		error = 0;
	}
	
	var errsig  = document.getElementById("errsig");
	var esignature = document.myForm.esignature;
	if(esignature.value === "")
	{
		errsig.setAttribute("style","visibility:visible");
		document.getElementById('esignature').style.borderColor = "red";
		error = 1;
	}
	else {
		errsig.setAttribute("style","visibility:hidden");
		error = 0;
	}
	
	if (error == 0){
		return true;
	}
	else{
		return false;
	}
	
    }
</script>

</body>
</html>

