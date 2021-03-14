<?php
if (!empty($_POST["login-btn"])) {
	
	require_once "./Model/Member.php";
    $member = new Member();
	$loginResult = $member->loginMember();
	
}
?>
		<div class="sign-up-container">
			<div class="login-signup">
				<a href="user-registration-form.php">Sign up</a>
			</div>
			<div class="signup-align">
				<form action="./identity.php" name="login"  method="post"
					onsubmit="return loginValidation()">
					<div class="signup-heading">Login</div>
					
				<?php if(empty($loginResult)){?>
				
				<div class="error-msg"><?php echo $loginResult;?></div>
				
				<?php }?>
				<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Username<span class="required error" id="username-info"></span>
							</div>
							<input class="input-box-330" type="text" name="username"
								id="username">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Password<span class="required error" id="signup-password-info"></span>
							</div>
							<input class="input-box-330" type="password"
								name="signup-password" id="signup-password">
								<p id="warn">WARNING! Caps lock is ON.</p>
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
					<label>
        
      </label>
</div>
					</div>
					

					<div class="row">
						<input class="sign-up-btn" type="submit" name="login-btn"
							id="login-btn" value="Login">
					</div>

					
				</form>
			</div>
		</div>

	<script>
function loginValidation() {
	var valid = true;
	$("#username").removeClass("error-field");
	$("#password").removeClass("error-field");
	
	var UserName = $("#username").val();
	var Password = $('#signup-password').val();
    
	$("#username-info").html("").hide();
	$("#email-info").html("").hide();

	if (UserName.trim() == "") {
		$("#username-info").html("required.").css("color", "#ee0000").show();
		$("#username").addClass("error-field");
		valid = false;
	}
	if (Password.trim() == "") {
		$("#signup-password-info").html("required.").css("color", "#ee0000").show();
		$("#signup-password").addClass("error-field");
		valid = false;
	}
	if (valid == false) {
		$('.error-field').first().focus();
		valid = false;
	}
	return valid;	
}

// Get the input field
var pw = document.getElementById("signup-password");

// Get the warning text
var warn = document.getElementById("warn");

// When the user presses any key on the keyboard, run the function
pw.addEventListener("keyup", function(event) {

  // If "caps lock" is pressed, display the warning text
  if (event.getModifierState("CapsLock")) {
    warn.style.display = "block";
  } else {
    warn.style.display = "none"
  }
});

</script>