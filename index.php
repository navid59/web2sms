<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('lib/sendSMS.php');
$sendSMS = new sendSMS();

$sendSMS->apiKey    = ''; // your api key here
$sendSMS->secretKey = ''; // your secret key here
$sendSMS->username  = ''; // Your Username here

$sendSMS->messages[]  = [
                    'sender'            => null,                            // who send the SMS             // Optional
                    'recipient'         => '0770997789',                    // who recive the SMS           // Mandatory
                    'body'              => 'This is Test'.rand(0,1000),     // The actual text of SMS       // Mandatory
                    'scheduleDatetime'  => '2021-07-16 16:30:00',                            // Data & Time to send SMS      // Optional
                    'validityDatetime'  => null,                            // Data & Time of expire SMS    // Optional
                    'callbackUrl'       => null,                            // Call back                    // Optional    
                    'userData'          => null,                            // User data                    // Optional
                    'visibleMessage'    => true                             // visible of Message           // Optional
                    ];

// $sendSMS->messages[]  = [
//                     'sender'            => null,
//                     'recipient'         => '0770997789',
//                     'body'              => 'This is Test nr 2222-'.rand(0,1000),
//                     'scheduleDatetime'  => null,
//                     'validityDatetime'  => null,
//                     'callbackUrl'       => null,    
//                     'userData'          => null,
//                     'visibleMessage'    => false
//                     ];

// $sendSMS->messages[]  = [
//                     'sender'            => null,
//                     'recipient'         => '0770997789',
//                     'body'              => 'This is Test nr 3333-'.rand(0,1000),
//                     ];

// $sendSMS->messages[]  = [
//                     'recipient'         => '0770997789',
//                     'body'              => 'This is Test nr 4444-'.rand(0,1000)
//                     ];


$sendSMS->setRequest();
$sendSMS->sendSMS();





