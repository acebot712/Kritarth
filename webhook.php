<?php
/*
Basic PHP script to handle Instamojo RAP webhook.
*/

include("dbcred.php");
$link = mysqli_connect("localhost", $user, $pass, $db);
    if (mysqli_connect_error()) {
        die("Database Connection Error");
    }

$data = $_POST;
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.
$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];
if($major >= 5 and $minor >= 4){
     ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
     uksort($data, 'strcasecmp');
}
// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without <>
$mac_calculated = hash_hmac("sha1", implode("|", $data), "7f834d2254db4ce5b1f0dccdbf6806d2");
if($mac_provided == $mac_calculated){
    if($data['status'] == "Credit"){
        // Payment was successful, mark it as successful in your database.
        // You can acess payment_request_id, purpose etc here. 
        $query = "UPDATE `users` SET paid = ".mysqli_real_escape_string($link,$data['amount'])."  WHERE id = ".mysqli_real_escape_string($link,$data['purpose'])." LIMIT 1";
        mysqli_query($link,$query);
    }
    else{

        // Payment was unsuccessful, mark it as failed in your database.
        // You can acess payment_request_id, purpose etc here.
    }
    $query = "INSERT INTO `webhook` (`payment_id`, `payment_request_id`, `kritarth_id`, `status`) VALUES ('".mysqli_real_escape_string($data['payment_id'])."','".mysqli_real_escape_string($data['payment_request_id'])."','".mysqli_real_escape_string($data['purpose'])."','".mysqli_real_escape_string($data['status'])."')";
        mysqli_query($link,$query);
}
else{
    echo "MAC mismatch";
}

?>