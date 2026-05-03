<?php
session_start();

$mobile = $_SESSION['mobile'];

$otp = rand(100000, 999999);

$_SESSION['otp'] = $otp;
$_SESSION['otp_time'] = time();

// Send OTP again
$apiKey = "9EJh6KacH0sqAWdxzC7ULN3ZliFjDyV2PYrMQek54gTfobGumwotOAIy5uv4ZGsn3VdkNXw2xW8ribfh";

$message = "Your OTP is: $otp";

$url = "https://www.fast2sms.com/dev/bulkV2?authorization=$apiKey&route=quick&message=" . urlencode($message) . "&numbers=$mobile";
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
));

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>