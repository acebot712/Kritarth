
<!--
======================Page for Pay later with unique id================================
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<?php

			session_start();

			include("dbcred.php");

			$error = "";

			if(array_key_exists("paynow", $_POST)) {
				$link = mysqli_connect("localhost", $user, $pass, $db);
		        if (mysqli_connect_error()) {
		            die("Database Connection Error");
		        }

		        if (!$_POST['regid']) {
		            $error .= "Please Enter your unique ID<br>";
		        }

		        if ($error != "") {
		        	$error = "<p>Oops! Please rectify the following:</p>".$error;
		        	# code...
		        } else {
		        	$query = "SELECT `id` FROM `users` WHERE regid = '".mysqli_real_escape_string($link, $_POST['regid'])."' LIMIT 1";

		            $result = mysqli_query($link, $query);

		            if (mysqli_num_rows($result) > 0) {
		            	if (!mysqli_query($link, $query)) {

		                	$error = "<p>Our servers are down at the moment - please try again later.</p>";

		                } else {

		                	$_SESSION['id'] = mysqli_insert_id($link);
		                	header("Location: instamojo.php");
		                }

		            } else{
		            	$error = "Please enter a valid ID";
		            }
		        }
		    }
		?>


		<?php include("header.php"); ?>
		<div class="container border rounded" style="width: 900px;margin-top: 15%;">
		<div id="error"><?php if($error != ""){
		            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
		            } ?>
		</div>
		<form method="post">

		  <div class="form-group row">
		    <label for="regid" class="col-sm-4 col-form-label">Enter Your Kritarth ID</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="regid" id="regid" placeholder="-------">
		    </div>
		  </div>
		  <div class="col">
		  	<button name="paynow" type="submit" class="btn btn-primary">Pay Now!</button>
		  </div>
		</form>
		<p><p><a id="showPayNow" href="index.php">Haven't registered yet? Register Now.</a></p></p>
		</div>

		<?php include("footer.php") ?>

	</body>
</html>
