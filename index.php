<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('lib/sendSMS.php');
use Web2sms\sendSMS;

$sendSMS = new sendSMS();

$sendSMS->apiKey    = '6997cfcc09caa439fab3d28e466e34a1f96f3eab';
$sendSMS->secretKey = '303ed8f4c1b541464aa15dadf0f9b28099aa7ec0954de53b01a07f8ba2ad951426344c0eafae3b04489bcf456bdb797804105eb913657ed29ab301dd566fdbb9';

$sendSMS->messages[]  = [
                    'sender'            => null,                                    // who send the SMS             // Optional
                    'recipient'         => '0770997789',                            // who recive the SMS           // Mandatory
                    'body'              => 'This is scheduled SMS for 14:22- '.rand(0,1000), // The actual text of SMS       // Mandatory
                    'scheduleDatetime'  => '2021-07-20 14:22:00',                                      // Data & Time to send SMS      // Optional
                    'validityDatetime'  => null,                                    // Data & Time of expire SMS    // Optional
                    'callbackUrl'       => 'https://navid.ro/web2sms/',             // Call back                    // Optional    
                    'userData'          => null,                                    // User data                    // Optional
                    'visibleMessage'    => false                                    // false -> show the Org Msg & True is not showing the Org Msg           // Optional
                    ];

$sendSMS->setRequest();
$sendSMS->sendSMS();





