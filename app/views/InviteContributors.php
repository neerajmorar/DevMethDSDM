<?php
$pageTitle = 'Invite Contributors';
require '../public/_header.php';
?>

</header>

<div id="content">
    
    <form id="myForm" name="myForm" onsubmit="" method="POST" action="form_script.php" >
			
        
		<div class="table-layout">
                    <h2><?php echo $pageTitle; ?></h2>
                    <p id="feedback"></p>
                    
                    <input type='reset' value='Clear Form' />
                    <input type='submit' value='Send Email' onclick="return validate();" />
                    <br />
                    <br />
                    
                    <div class="left-col">
                        <div class="row-1">
                            <label>Event Title:*</label><span id="errevent" class="err">Event Title is required</span>
                            <select name="event" id="event"> 
					<option value="0">Please Select</option>
					<?php 
                                            foreach($data[0] as $e)
                                            {
                                                echo "<option value='" . $e["eventID"] . "'>" . $e["name"] . "</option>";
                                            }
                                        ?>
                            </select>
                            
                        </div>
                        <div class="row-2">
                            <label>Enter Contributor's Email:</label>
                            <input name="cemail" type="email" multiple id="cemail" />
                            <input type='button' value='ADD' style='width: 60px; padding: 0px;' onclick='add()' />
                        </div>
                        <div class='row-3'>
                            <label>Selected Contributors:*</label><span id="errinf" class="err">Contributors required</span>
                            <TEXTAREA rows="6" cols="40" name="inf" id="inf" readonly></TEXTAREA>
                            
                        </div>
                        <div class="row-4">
                            <label>Email Type:*</label><span id="erretype" class="err">Email Type is required</span>
                            <select name="etype" id="etype"  onChange="">
					<option value="0">Please Select</option>
					<option value="1">Abstract</option>
					<option value="2">Presentation</option>
                                        <option value='3'>Final Invitation</option>
                            </select>
                            
                        </div>
                        <div class="row-5">
                            <label>Sender's Email:*</label><span id="errsemail" class="err">Sender's Email is required</span>
                            <input type="email" name="semail" id="semail">
                            
                        </div>
                        <div class='row-6'>
                            <label>Attachment:</label>
                            <input type="file" multiple name="attach" id="attach" />
                        </div>
                    </div>
                    <div class="right-col">
                        <div class='row-1'>
                            <label>Subject:*</label><span id="errsubject" class="err">Subject is required</span>
                            <input type="text" name="subject" id="subject">
                            
                        </div>
                        <div class='row-2'>
                            <label>Greeting:*</label><span id="errgreeting" class="err">Greeting is required</span>
                            <input type="text" name="greeting" id="greeting" />
                            
                        </div>
                        <div class='row-3'>
                            <label>Message:*</label><span id="errmessage" class="err">Message is required</span>
                            <textarea rows="6" cols="80" name="message" id="message"></textarea>
                            
                        </div>
                        <div class='row-4'>
                            <label>Email Signature:*</label><span id="errsig" class="err">Email Signature is required</span>
                            <textarea rows='5' cols='50' name="esignature" id="esignature" ></textarea>
                            
                        </div>
                    </div>
                </div>
				
               

    </form>
</div>

<script type='text/javascript'>
    
   function add() { 
	var cemail;
	var userinfo="";
	userinfo += document.getElementById('cemail').value +"\n"; 
	document.getElementById('inf').value= userinfo;
	return inf;
}


function validate(){
	
	var err = 0;
	
	var errevent = document.getElementById("errevent");
	var event = document.myForm.event.value;
	if(event == 0)
	{
		errevent.style.visibility = "visible";
		document.getElementById('event').style.borderColor = "red";
		err = 1;
	}else {
		errevent.style.visibility = "hidden";
		err = 0;
	}
	
	var errinf = document.getElementById("errinf");
	var inf = document.myForm.inf;
	if(inf.value === "")
	{
		errinf.setAttribute("style","visibility:visible");
		document.getElementById('inf').style.borderColor = "red";
		err = 1;
	}
	else {
		errinf.setAttribute("style","visibility:hidden");
		err = 0;
	}
	
	var erretype = document.getElementById("erretype");
	var etype = document.myForm.etype.value;
	if(etype == 0)
	{
		erretype.style.visibility = "visible";
		document.getElementById('etype').style.borderColor = "red";
		err = 1;
	}
	else {
		erretype.style.visibility = "hidden";
		err = 0;
	}
	
	var errsemail = document.getElementById("errsemail");
	var semail = document.myForm.semail;
	if(semail.value === "")
	{
		errsemail.setAttribute("style","visibility:visible");
		document.getElementById('semail').style.borderColor = "red";
		err = 1;
	}
	else {
		errsemail.setAttribute("style","visibility:hidden");
		err = 0;
	}
	
	var errsubject = document.getElementById("errsubject");
	var subject = document.myForm.subject;
	if(subject.value === "")
	{
		errsubject.setAttribute("style","visibility:visible");
		document.getElementById('subject').style.borderColor = "red";
		err = 1;
	}
	else {
		errsubject.setAttribute("style","visibility:hidden");
		err = 0;
	}
	
	var errgreeting  = document.getElementById("errgreeting");
	var greeting = document.myForm.greeting;
	if(greeting.value === "")
	{
		errgreeting.setAttribute("style","visibility:visible");
		document.getElementById('greeting').style.borderColor = "red";
		err = 1;
	}
	else {
		errgreeting.setAttribute("style","visibility:hidden");
		err = 0;
	}
	
	var errmessage  = document.getElementById("errmessage");
	var message = document.myForm.message;
	if(message.value === "")
	{
		errmessage.setAttribute("style","visibility:visible");
		document.getElementById('message').style.borderColor = "red";
		err = 1;
	}
	else {
		errmessage.setAttribute("style","visibility:hidden");
		err = 0;
	}
	
	var errsig  = document.getElementById("errsig");
	var esignature = document.myForm.esignature;
	if(esignature.value === "")
	{
		errsig.setAttribute("style","visibility:visible");
		document.getElementById('esignature').style.borderColor = "red";
		err = 1;
	}
	else {
		errsig.setAttribute("style","visibility:hidden");
		err = 0;
	}
	
	if (err == 0){
		return true;
	}
	else{
		return false;
	}
	
    }
</script>

</body>
</html>

