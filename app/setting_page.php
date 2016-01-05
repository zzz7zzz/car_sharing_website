<!-- 
<script type="text/javascript">
$(document).ready(function() {
   $("#delete").click(function()
  	{
   		$.ajax(
      	{
            url: "deleteAccount.php",
            type: "POST",
        	data:
        	{
            	locFrom: $("#locFrom").val(),
                locTo: $("#locTo").val(),
                timeFrom: startTime,
                timeTo: endTime,
        	},
            dataType: "text",
        	success: function(dat)
        	{	
    			window.location = "Home.php";
        	},
    	});
    	
    	
		
	}); 
}
</script>
 -->

<div id="bottom">
	<div id="setting">
<!-- 
		<h1>Upload my photo</h1>
		<input type="button" id="uploadButton" name="upload" value="Select files" class="button-secondary"/>
 -->
		<div id="changePwd">
	    <h1>Change my password </h1>
	    
		<form action="app/changePassword.php" method = 'POST' name="change-password">
			<table cellspacing="2" cellpadding="2" border="0">
				<tr>
				  <td align="right">
					Type your old password
				  </td>
				  <td>
					<input type="password" name="Old_password" />
				  </td>
				  <td>
					<div id='change-password_Old_password_errorloc' class="error_strings"></div>
				  </td>
				</tr>
		
				<tr>
				  <td align="right">
					Type your new password
				  </td>
				  <td>
					<input type="password" name="New_password" />
				  </td>
				  <td>
					<div id='change-password_New_password_errorloc' class="error_strings"></div>
				  </td>
				</tr>
				
				<tr>
				  <td align="right">
					Confirm your new password
				  </td>
				  <td>
					<input type="password" name="Confirmed_password" />
				  </td>
				  <td>
					<div id='change-password_Confirmed_password_errorloc' class="error_strings"></div>
				  </td>
				</tr>
				
				<tr>
				  <td align="right"></td>
				  <td>
					<input type="submit" value="Submit" />
				  </td>
                </tr>
			</table>
	    </form>
	    <script language="JavaScript" type="text/javascript"
			xml:space="preserve">
		  //You should create the validator only after the definition of the HTML form
		  var frmvalidator  = new Validator("change-password");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();

			frmvalidator.addValidation("Old_password","req","Required field");
			frmvalidator.addValidation("New_password","req","Required field");
			frmvalidator.addValidation("Confirmed_password","req","Required field");
			frmvalidator.addValidation("Confirmed_password","eqelmnt=New_password",
		 "The confirmed password does not match password");
		</script>

<div id="changePwdResult">
<?php
if (isset($_GET['err']) && $_GET['err'] == 1)
{
  echo '<span style="color: red;">Wrong passord entered</span><br/>';
}

?>
</div>	
</div>		
<h1>Delete my account</h1>
<form action="app/deleteAccount.php" method = 'POST' name="delete-account">
	<input type="password" name="checkAcctPassword" placeholder="password"/>
	<input type="submit" id="delete" name="deleteAccountPwd" value="Delete" />  <!-- class="button-secondary" -->
</form>

<script language="JavaScript" type="text/javascript"
	xml:space="preserve">
  //You should create the validator only after the definition of the HTML form
  var frmvalidator  = new Validator("delete-account");
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("checkAcctPassword","req","Required field");
</script>
<?php
if (isset($_GET['err']) && $_GET['err'] == 2)
{
  echo '<span style="color: red;">Wrong passord entered</span><br/>';
}

?>
	</div>
</div>