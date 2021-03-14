<?php
	if(isset($_POST["reset-password"])) {
		$conn = mysqli_connect("localhost", "root", "", "blog_samples");
		$sql = "UPDATE `blog_samples`.`members` SET `member_password` = '" . md5($_POST["member_password"]). "' WHERE `members`.`member_name` = '" . $_GET["name"] . "'";
		$result = mysqli_query($conn,$sql);
		$success_message = "Password is reset successfully.";
		
	}
?>
<link href="demo-style.css" rel="stylesheet" type="text/css">
<script>
function validate_password_reset() {
	if((document.getElementById("member_password").value == "") && (document.getElementById("confirm_password").value == "")) {
		document.getElementById("validation-message").innerHTML = "Please enter new password!"
		return false;
	}
	if(document.getElementById("member_password").value  != document.getElementById("confirm_password").value) {
		document.getElementById("validation-message").innerHTML = "Both password should be same!"
		return false;
	}
	
	return true;
}
</script>
<form name="frmReset" id="frmReset" method="post" onSubmit="return validate_password_reset();">
<div class="signup-align">
<div class="show-title">Reset Password</div>
	<?php if(!empty($success_message)) { ?>
	<div class="success_message"><?php echo $success_message; ?></div>
	<?php } ?>

	<div id="validation-message">
		<?php if(!empty($error_message)) { ?>
	<?php echo $error_message; ?>
	<?php } ?>
	</div>

	<div class="row">
	<div class="field-group">
	<div class="form-label">Password</div>
		<div>
		<input type="password" name="member_password" id="member_password" class="input-field"></div>
		<br />
		<input type="checkbox" name="show" style="margin-bottom: 1px;text-align: left;" onclick="if(document.getElementById('member_password').type=='text')document.getElementById('member_password').type='password'; else document.getElementById('member_password').type='text';" /> Show Password
		<p id="warn">WARNING! Caps lock is ON.</p>
	</div>
	</div>
	
	<div class="row">
	<div class="field-group">
	<div class="form-label">Confirm Password</div>
		<div><input type="password" name="confirm_password" id="confirm_password" class="input-field"></div>
		<br />
		<input type="checkbox" name="show" style="margin-bottom: 1px; text-align: left;" onclick="if(document.getElementById('confirm_password').type=='text')document.getElementById('confirm_password').type='password'; else document.getElementById('confirm_password').type='text';" /> Show Password
		<p id="warn1">WARNING! Caps lock is ON.</p>
	</div>
	</div>

	<div class="row">
	<div class="field-group">
		<div><input type="submit" name="reset-password" id="reset-password" value="Reset Password" class="form-submit-button"></div>
	</div>	
	</div>
	</div>
</form>
				

<script>

var pw = document.getElementById("member_password");
var pw1 = document.getElementById("confirm_password");
// Get the warning text
var warn = document.getElementById("warn");
var warn1 = document.getElementById("warn1");

// When the user presses any key on the keyboard, run the function
pw.addEventListener("keyup", function(event) {

  // If "caps lock" is pressed, display the warning text
  if (event.getModifierState("CapsLock")) {
    warn.style.display = "block";
  } else {
    warn.style.display = "none"
  }
});

pw1.addEventListener("keyup", function(event) {

// If "caps lock" is pressed, display the warning text
if (event.getModifierState("CapsLock")) {
  warn1.style.display = "block";
} else {
  warn1.style.display = "none"
}
});

	</script>