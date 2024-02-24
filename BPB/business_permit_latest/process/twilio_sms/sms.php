<?php

// Include the Twilio PHP library
require_once 'vendor/autoload.php'; // Make sure to install the Twilio PHP library using Composer
// require_once '../conn.php';



// Replace with your Twilio Account SID and Auth Token
$accountSid = 'AC730fd6942d9804dc0a0a1300fb007413';
$authToken = 'd353b1c4b5adb1049d3cf1b2ef8fc306';

// $requester = $_POST['requester'];
// Replace with your Twilio phone number and the recipient's phone number
$fromNumber = '+14056793845'; // Your Twilio phone number
// $toNumber = '+639563119452';   // Recipient's phone number


$toNumber = $_GET['number'];
$toNumber = "+".trim($toNumber);
echo $toNumber;

// die();


// Replace with your SMS message
$messageBody = 'Your business permit is approved and ready for pickup. Visit our office during business hours. Thank you!
Best Regards,
BPB-SARIAYA QUEZON';

// Initialize Twilio client
$client = new Twilio\Rest\Client($accountSid, $authToken);

// Send SMS
try {
    $message = $client->messages->create(
        $toNumber,
        [
            'from' => $fromNumber,
            'body' => $messageBody
        ]
    );
    echo 'SMS sent with SID: ' . $message->sid;
} catch (Exception $e) {
    echo 'Error sending SMS: ' . $e->getMessage();
}
?>
