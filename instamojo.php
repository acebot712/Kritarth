<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:f39babbd2b72bebd3d1bfe960b8f8f7a",
                  "X-Auth-Token:9c11e0a9767a322f45d25224134c3e2c"));

$id = $_GET['regid'];
$name = $_GET['name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$kiitian = $_GET['kiitian'];
$noofevents = $_GET['noofevents'];


$payload = Array(
    'purpose' => $id,
    'amount' => '150',
    'phone' => $phone,
    'buyer_name' => $name,
    'redirect_url' => 'http://www.kritarth.org/success.php',
    'send_email' => true,
    'webhook' => 'http://www.kritarth.org/webhook.php',
    'send_sms' => true,
    'email' => $email,
    'allow_repeated_payments' => false
);

if($kiitian == 'KIITian'){
    $payload['amount'] = '206';

}else if($kiitian == 'University'){
    if($noofevents == 1){
        $payload['amount'] = '206';
    }
    else{
        $payload['amount'] = '256';
    }
}else if($kiitian == 'School'){
    if($noofevents == 1){
        $payload['amount'] = '105';
    }else{
        $payload['amount'] = '156';
    }

}

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

$paymentArray = json_decode($response, true);
 print_r($paymentArray);
$long_url = $paymentArray['payment_request']['longurl'];
header('Location: '.$long_url);

?>