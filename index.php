<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('lib/sendSMS.php');
use Web2sms\sendSMS;

$sendSMS = new sendSMS();

$sendSMS->accountType = 'prepaid';                                                  // postpaid | prepaid
$sendSMS->apiKey     = 'YOUR_API_KEY_HERE_._YOU_HAVE_IT_FROM_WEB2SMS_PLATFORM';
$sendSMS->secretKey  = 'YOUR_SECRET_KEY_HERE_._YOU_HAVE_IT_FROM_WEB2SMS_PLATFORM';

$sendSMS->messages[]  = [
                    'sender'            => null,                                    // who send the SMS             // Optional
                    'recipient'         => '0770997789',                            // who receive the SMS          // Mandatory
                    'body'              => 'This is a simple SMS PREPAID - '.rand(0,1000),  // The actual text of SMS       // Mandatory
                    'scheduleDatetime'  => null,                                    // Date & Time to send SMS      // Optional
                    'validityDatetime'  => null,                                    // Date & Time of expire SMS    // Optional
                    'callbackUrl'       => 'https://navid.ro/web2sms/',             // Call back                    // Optional    
                    'userData'          => null,                                    // User data                    // Optional
                    'visibleMessage'    => false                                    // false -> show the Org Msg & True is not showing the Org Msg           // Optional
                    ];

$sendSMS->setRequest();
$result = $sendSMS->sendSMS();
print_r($result);




