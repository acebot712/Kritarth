<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:f39babbd2b72bebd3d1bfe960b8f8f7a",
                  "X-Auth-Token:9c11e0a9767a322f45d25224134c3e2c"));
$payload = Array(
    'purpose' => 'Self',
    'amount' => '150',
    'phone' => '9679191749',
    'buyer_name' => 'Srishti',
    'redirect_url' => 'http://localhost/success.php',
    'send_email' => true,
    'webhook' => '',
    'send_sms' => true,
    'email' => 'foo@example.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 

$paymentArray = json_decode($response, true);
$long_url = $paymentArray['payment_request']['longurl'];
header('Location: '.$long_url);

?>