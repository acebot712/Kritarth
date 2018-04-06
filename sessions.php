<!--
=========================Redirect page after successful sign up=======================
-->

<?php

	session_start();

	if (array_key_exists("id", $_SESSION)) {
        
		# code...
        //print_r($_SESSION);
	}else{
        //print_r($_POST);
		//header("Location: index.php");
	}

?>

<?php include("header.php"); ?>

	<div class="container" style="width: 1000px;">
	<div class="col-sm-10">
		<p>Your have been registered successfully.<br></p>
		<form method="post">
		<a name="paynow" type="submit" class="btn btn-primary" href="paywithid.php?regid=<?php if(array_key_exists("id", $_SESSION)){echo $_SESSION['id'];} ?>">Pay now</a>
		</form>

		<p><p><b>OR</b></p></p>
		<p>you may pay later with the unique Kritarth ID that has been sent your email address.</p>
		<p><a href='index.php'>Return to homepage</a></p>
	</div>
	</div>

<?php include("footer.php"); ?>