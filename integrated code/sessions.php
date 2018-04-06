<!--
=========================Redirect page after successful sign up=======================
-->

<?php

	session_start();

	if (array_key_exists("id", $_SESSION)) {
        
		# code...
        print_r($_SESSION);
	}else{
        print_r($_POST);
		header("Location: connect.php");
	}

?>

<?php include("header.php"); ?>

	<div class="container" style="width: 1000px;">
	<div class="col-sm-10">
		<p>Your have been registered successfully.<br></p>
		<form method="post">
		<button name="paynow" type="submit" class="btn btn-primary" href="instamojo.php">
		Pay now
		</button>
		</form>

		<p><p><b>OR</b></p></p>
		<p>you may pay later with the unique Kritarth ID that has been sent your email address.</p>
		<p><a href='connect.php'>Return to homepage</a></p>
	</div>
	</div>

<?php include("footer.php"); ?>