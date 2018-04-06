<?php
//echo "in";
	include("dbcred.php");

	$error = "";

    if (array_key_exists("submit", $_POST)) {


        $link = mysqli_connect("localhost", $user, $pass, $db);

        if (mysqli_connect_error()) {
            die("Database Connection Error");
        }

        $returnArray=[];

        //CSRF
        /*if(isset($_SESSION['csrf'])){
	        if( md5 ($_SESSION['csrf'])!=($_POST['csrf'])){

	        	$error .= "Invalid session! Restart your browser.<br>";
	        }
				}
					else{
					$error .= "Invalid session! Restart your browser.<br>";
	    	}*/
        if (!($_POST['name'])||(empty($_POST['name']))) {
            $error .= "Enter your name<br>";
        }

        if (!($_POST['email'])||(empty($_POST['email']))) {
        	$error .= "Enter a valid Email address<br>";
        }

        if (!($_POST['age'])||(empty($_POST['age']))) {
        	$error .= "DOB is required<br>";
        }

        if (!($_POST['phone'])||(empty($_POST['phone']))) {
        	$error .= "Enter a valid Contact number<br>";
        }
        if(($_POST['event1']==-1)&&($_POST['event2']==-1)){
        	$error .= "Select at least one event<br>";
        }
        if($_POST['kiitian']=="University"){
	            		if(!$_POST['university']||empty($_POST['university'])){
	            			$error .= "Please enter name of your university<br>";
	            		}
	            	}
	            	if($_POST['kiitian']=="School"){
	            		if(!$_POST['school']||empty($_POST['school'])){
	            			$error .= "Please enter name of your school<br>";
	            		}
	            	}
	    if($_POST['kiitian']=='KIITian'){
	    	if(!$_POST['rollno']||empty($_POST['rollno'])){
	            $error .= "Please enter your KIIT roll no<br>";
	        }
	    }
        if($error!="")
	                	{
	                		$returnArray['errorStatus']=true;
	                		$returnArray['error']=$error;

	                		$returnArray=json_encode($returnArray);
	                		echo $returnArray;
	                		die();

	                	}
	                	$returnArray['error']=false;


        if ($error != "") {
        	$error = "<p>Following fields are invalid:</p>".$error;
        	if($error!="")
	                	{
	                		$returnArray['errorStatus']=true;
	                		$returnArray['error']=$error;

	                		$returnArray=json_encode($returnArray);
	                		echo $returnArray;
	                		die();
	                	}
	                	$returnArray['error']=false;
        } else{

            $query1 = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $query2 = "SELECT `id` FROM `users` WHERE phone = '".mysqli_real_escape_string($link, $_POST['phone'])."' LIMIT 1";

            $result1 = mysqli_query($link, $query1);
            $result2 = mysqli_query($link, $query2);
            

            if (mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0){

            	if(mysqli_num_rows($result1) > 0){
            		$error =  "This email address has already been registered<br>";

            	}else{
            		$error = "This phone number has already been registered<br>";
            	}
            	if($error!="")
	                	{
	                		$returnArray['errorStatus']=true;
	                		$returnArray['error']=$error;

	                		$returnArray=json_encode($returnArray);
	                		echo $returnArray;
	                		die();
	                	}

            }else
            {

	            	$name = trim($_POST['name']," ");
	            	$rollno = trim($_POST['rollno']," ");
	            	$university = trim($_POST['university']," ");
	            	if ($_POST['kiitian']=="School") {
	            		# code...
	            		$school = trim($_POST['school']," ");
	            	}else if($_POST['kiitian']=="University"){
	            		$school = trim($_POST['university']," ");
	            	}
	            	
	            	$email = trim($_POST['email']," ");
	            	$phone = trim($_POST['phone']," ");


	            	if($_POST['kiitian']=="KIITian")
	            	{
		            		$query = "SELECT `id` FROM `users` WHERE rollno = '".mysqli_real_escape_string($link, $_POST['rollno'])."' LIMIT 1";
		            	

		           			 $result = mysqli_query($link, $query);

				            if (mysqli_num_rows($result) > 0) {
				                $error = "This roll no has already registered.";
				                if($error!="")
				                	{
				                		$returnArray['errorStatus']=true;
				                		$returnArray['error']=$error;

				                		$returnArray=json_encode($returnArray);
				                		echo $returnArray;
				                		die();
				                	}
				                	$returnArray['error']=false;
			                    }
	                	


	            	}else{

	            		$rollno="";
	            	}
	            	

								//die('example');

								$query = "INSERT INTO `users` (`name`, `rollno`, `university`,`school`, `email`, `age`, `gender`, `phone`, `event1`, `event2`) VALUES ('".mysqli_real_escape_string($link, $name)."', '".mysqli_real_escape_string($link, $rollno)."', '".mysqli_real_escape_string($link, $_POST['kiitian'])."', '".mysqli_real_escape_string($link, $school)."', '".mysqli_real_escape_string($link, $email)."', '".mysqli_real_escape_string($link, $_POST['age'])."', '".mysqli_real_escape_string($link, $_POST['gender'])."', '".mysqli_real_escape_string($link, $phone)."', '".mysqli_real_escape_string($link, $_POST['event1'])."', '".mysqli_real_escape_string($link, $_POST['event2'])."')";


	                	$lastIDInserted=mysqli_insert_id($link);


	                if (!mysqli_query($link, $query)) {

	                	$error = "<p>There was a problem signing you up - please try again later.</p>";
	                	if($error!="")
	                	{
	                		$returnArray['errorStatus']=true;
	                		$returnArray['error']=$error;

	                		$returnArray=json_encode($returnArray);
	                		echo $returnArray;
	                		die();
	                	}
	                	$returnArray['error']=false;

	                } else {

	                	$kritarthID = sprintf("KR%05d",mysqli_insert_id($link));

	                	$query = "UPDATE `users` SET regid = '".$kritarthID."', md5key = '".md5($lastIDInserted.$_POST['email'])."' WHERE id = ".mysqli_insert_id($link)." ";
	                	mysqli_query($link,$query);


	                	//$query = "UPDATE `users` SET  WHERE id = ".$lastIDInserted." LIMIT 1";
	                	//mysqli_query($link,$query);
	                	//die(!$lastIDInserted);


					//Sessions declarations

	                	$_SESSION['id'] = $kritarthID;
	                	$_SESSION['name'] = $_POST['name'];
	                	$_SESSION['email'] = $_POST['email'];
	                	$_SESSION['phone'] = $_POST['phone'];
	                	$_SESSION['kiitian'] = $_POST['kiitian'];

	                	if($_POST['event1']&&$_POST['event2']){
	                		$_SESSION['noofevents'] = 2;
	                	}
	                	else{
	                		$_SESSION['noofevents'] = 1;
	                	}

	                		///Mail for verification


						      $code=md5($lastIDInserted.$_POST['email']);


						        require_once('PHPMailer/PHPMailerAutoload.php');
						        require_once('PHPMailer/class.phpmailer.php');
						        require_once('PHPMailer/class.smtp.php');


						        $mail = new PHPMailer;
						        $mail->isSMTP();/*Set mailer to use SMTP*/
						        $mail->Host = "smtp.mandrillapp.com"; // sets the SMTP server
						        $mail->Port = 587;
						        $mail->SMTPAuth = true;/*Enable SMTP authentication*/
						        $mail->Username = "Kritarth"; // SMTP account username
						        $mail->Password = "UQPuunKrJPNZbwUxYKJ_EQ";        // SMTP account password
						        $mail->SMTPSecure = 'tls';/*Enable encryption, 'ssl' also accepted*/
						        $mail->SetFrom('contact@kritarth.org');
						        $mail->addAddress($_POST['email']);/*Add a recipient*/
						        $mail->isHTML(true);/*Set email format to HTML (default = true)*/
						        $mail->Subject = 'Verify Your Account';

						        $body    = 'www.kritarth.org/activation.php?code='.$code;

						        $mail->MsgHTML($body)			;

						        if(!$mail->send()) {
						            echo 'Message could not be sent.';
						            echo 'Mailer Error: ' . $mail->ErrorInfo;
						        } else {
						          echo 'Mail Sent';
						        }

	                	$returnArray['errorStatus']=false;
	                	$returnArray['error']="true";
	                	$returnArray=json_encode($returnArray);
                        echo $returnArray;
	                	die();

	                }



	            }
	        }
				}




?>