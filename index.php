<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('lib/sendSMS.php');
$sendSMS = new sendSMS();

$sendSMS->apiKey           = '6997cfcc09caa439fab3d28e466e34a1f96f3eab';
$sendSMS->secretKey        = '303ed8f4c1b541464aa15dadf0f9b28099aa7ec0954de53b01a07f8ba2ad951426344c0eafae3b04489bcf456bdb797804105eb913657ed29ab301dd566fdbb9';
$sendSMS->username         = 'navid@netopia-system.com';
$sendSMS->messages          = [
                            'sender'            => null,            // who send the SMS             // Optional
                            'recipient'         => '0770997789',    // who recive the SMS           // Mandatory
                            'body'              => 'This is Test',  // The actual text of SMS       // Mandatory
                            'scheduleDatetime'  => null,            // Data & Time to send SMS      // Optional
                            'validityDatetime'  => null,            // Data & Time of expire SMS    // Optional
                            'callbackUrl'       => null,            // Call back                    // Optional    
                            'userData'          => null,            // User data                    // Optional
                            'visibleMessage'    => true            // visible of Message           // Optional
                            ];




$arrData  = array();
$jsonData = json_encode($arrData);
$sendSMS->sendRequest($jsonData);

// die(print_r($sendSMS));

$sender         = null;
$recipient      = '0770997789';
$message        = 'This is Test';
$scheduleDate   = null;
$validity       = null;
$callbackUrl    = null;
$userData       = null;





