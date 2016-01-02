<?php
$pageTitle = 'Invite Contributor';
require '../public/_header.php';
?>

</header>

<div id="content">
    <h2><?php echo $pageTitle; ?></h2>
    
    <form id="myForm" name="myForm" onsubmit="return validate()" method="POST">
			
        <input type='reset' value='Clear Form' />
        <input type='submit' value='Send Email'/>
		<div class="table-layout">	
                    <div class="left-col">
                        <div class="row-1">
                            <label>Event Title:</label>
                            <select name="event" id="event"  onChange="exchangeRate()"> 
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
                            <input name="cemail" type="text" id="cemail" />
                            <input type='button' value='Add' style='width: 60px; padding: 0px;' onclick='add()' />
                        </div>
                        <div class='row-3'>
                            <label>Selected Contributors:</label>
                            <TEXTAREA rows="10" cols="40" name="inf" id="inf" readonly></TEXTAREA>
                        </div>
                        <div class="row-4">
                            <label>Email Type:</label>
                            <select name="etype" id="etype"  onChange="">
					<option value="0">Please Select</option>
					<option value="1">Abstract</option>
					<option value="2">Presentation</option>
                                        <option value='3'>Final Invitation</option>
                            </select>
                        </div>
                        <div class="row-5">
                            <label>Sender's Email:</label>
                            <input type="email" name="semail" id="semail">
                        </div>
                        <div class='row-6'>
                            <label>Attachment:</label>
                            <input type="file" name="attach" id="attach" />
                        </div>
                    </div>
                    <div class="right-col">
                        <div class='row-1'>
                            <label>Subject:</label>
                            <input type="text" name="subject" id="subject">
                        </div>
                        <div class='row-2'>
                            <label>Greeting:</label>
                            <input type="text" name="greeting" id="greeting" />
                        </div>
                        <div class='row-3'>
                            <label>Email Body:</label>
                            <textarea rows="10" cols="80" name="message" id="message"></textarea>
                        </div>
                        <div class='row-4'>
                            <label>Email Signature:</label>
                            <textarea rows='10' cols='50'></textarea>
                        </div>
                    </div>
                </div>
				
                

    </form>
</div>

<script type='text/javascript'>
    var sevent = document.getElementById("sevent").value;
    var etype = document.getElementById("etype").value;
    var inf = document.getElementById("inf").value;
    var attach = document.getElementById('attach').value;
    var contributor = document.getElementById("contributor").value;



    function add() { 
            var cemail;
            var userinfo="";
            userinfo += document.getElementById('cemail').value +"\n"; 
            document.getElementById('inf').value= userinfo;
            return inf;
    }

    function validate(){
                    var semail = document.getElementById("semail").value;
                    var atpos = semail.indexOf("@");
                    var dotpos = semail.lastIndexOf(".");
                    var subject = document.getElementById("subject").value;
                    var greeting = document.getElementById("greeting").value;
                    var ebody = document.getElementById("ebody").value;
                    var esignature = document.getElementById("esignature").value;
                    var atpos = cemail.indexOf("@");
                    var dotpos = cemail.lastIndexOf(".");

            if((name == "") || (!name.match(/^[A-Za-z]*\s{1}[A-Za-z]*$/))){
            alert("Pease enter a valid name")
            return false;
            }
            else if ((radio1 == "")&&(radio2 == "" )) {
            alert("Please select your gender");
            return false;
            }
            else if ((cnumber == "") ||(!cnumber.match(/^[0-9]{11}$/))) {
                    alert("Enter a valid contact number");
                    return false;
            }
            else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 > semail.length) {
                    alert("Email address entered is not valid");
                    return false;
            }
            else if (sevent == "Please Select") {
                    alert("Please select receiving Country");
                    return false;
            }
            else if (etype == "Please Select") {
                    alert("Please select receiving Country");
                    return false;
            }
            else if(!isNumeric(Number(erate))) {
                    alert("Please enter a valid exchange rate");
                    return false;
            }
            else if ((asending <= 0) || (isNaN(Number(asending)))) {
                    alert("Please enter a valid Amount to send");
                    return false;
            }

            else if ((serv1 == "")&&(serv2 == "" )) {
                    alert("Please select your prefered service");
                    return false;
            }
            else if ((rname == "") (!name.match(/^[A-Za-z]*\s{1}[A-Za-z]*$/)))  {
                    alert("Receiver's name is required")
                    return false;
            }
            else if ((radio3 == "")&&(radio4 == "" )) {
                    alert("Please select Receiver's gender");
                    return false;
            }
            else{// All the data has been validated
                    alert("Validation completed");
            }
    }
</script>

</body>
</html>

