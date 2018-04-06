<?php

	session_start();

	include("dbcred.php");

	$error = "";

    if(array_key_exists("activate",$_POST)){

	if(isset($_POST['regid'])&&!empty($_POST['regid']&&isset($_GET['code'])&&!empty($_GET['code']))) {
		
        $link = mysqli_connect("localhost", $user, $pass, $db);
        
        if (mysqli_connect_error()) {  
            die("Database Connection Error");        
        }
        if ($error == "") {

            $query = "SELECT `id` FROM  `users` WHERE md5key = '".mysqli_real_escape_string($link,$_GET['code'])."' AND regid =  '".mysqli_real_escape_string($link,$_POST['regid'])."'";
            $result = mysqli_query($link,$query);
            
            if(mysqli_num_rows($result)==1){

            	$query = "UPDATE `users` SET  `verified` = 1 WHERE regid = '".mysqli_real_escape_string($link,$_POST['regid'])."' LIMIT 1";
                mysqli_query($link, $query);
                header("Location: paywithid.php?regid=".$_POST['regid']);

            }else{
                
            }
        }
    }
    else{


    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Activation</title>
</head>
<body>



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
    <button name="activate" type="submit" class="btn btn-primary">Activate!</button>
  </div>
</form>
</div>

</body>
</html>

