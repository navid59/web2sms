<?php
namespace Web2sms;

abstract class Web2sms {
    // Error code defination
    const INTERNAL_WEB2SMS_ERROR                                = 0x20000001; // 536870913 -> Internal web2SMS error 
    const E_AUTH_REQUIRED                                       = 0x10000001; // 268435457 -> No available account for the calling IP                             
    const ASSOCIATED_ACCOUNT_IS_DISABLED                        = 0x10000007; // 268435463 -> Associated account is disabled  
    const ASSOCIATED_ACCOUNT_IS_MISSCONFIGURED                  = 0x10000006; // 268435462 -> Associated account is missconfigured                                  
    const INTERNAL_WEB2SMS_ERROR_WHILE_CREATING_SMS_SENDER      = 0x10000008; // 268435464 -> Internal web2SMS error while creating SMS Sender                                   
    const WRONG_PHONE_NR_FORMAT_OR_OUTOF_VALIDATED_GSM_NETWORK  = 0x10000002; // 268435458 -> Parameter `phone` has a wrong format or it belongs to a GSM.Network that is not configured for the associated account!                                               
         
    const PHONE_NUMBER_IS_BLACK_LISTED                          = 0x1000000a; // 268435466 -> Phone number is black listed
    const OUTOF_GSM_NETWORK_RENGE                               = 0x10000040; // 268435520 -> Phone number belongs to a GSN Network that is not configured for the associated account 
    const EXCEEDED_MONTHLY_LIMIT_TO_SENDING_SMS                 = 0x10000004; // 268435460 -> You’ve exceeded your monthly limit for SMS sending
    const WRONG_SCHEDULE_DATE_TIME                              = 0x10000020; // 268435488 -> You are trying to schedule a SMS message outside the configured time interval restrictions
    const SMS_MESSAGE_IS_EMPTY_THE_EMPTY_MSG_ARE_NOT_ALLOWED    = 0x10000003; // 268435459 -> Parameter `message` is empty! Empty message are not allowed 
    const INTERNAL_WEB2SMS_ERROR_WHILE_SCHEDULING_A_SMS         = 0x10000009; // 268435465 -> Internal web2SMS error while scheduling a SMS
    
    const SMS_METHOD         = "POST";
    const SMS_URL            = "/prepaid/message";

    public $apiKey;
    public $secretKey;
    public $username;
    public $messages;


    // "nonce" => time() // Current LINUX Timestamp
    public function __construct(){
        //
    }
    
    // Send request json to SMS
    public function sendRequest($smsItem) {
       $string = $this->apiKey . $smsItem->nonce . self::SMS_METHOD . self::SMS_URL . $smsItem->sender .
       $smsItem->recipient . $smsItem->body . $smsItem->visibleMessage . $smsItem->scheduleDatetime .
       $smsItem->validityDatetime . $smsItem->callbackUrl . $this->secretKey;

       $signature = hash('sha512', $string);

       $data = array(
        "apiKey" => $this->apiKey,
        "sender" => $smsItem->sender,
        "recipient" => $smsItem->recipient,
        "message" => $smsItem->body,
        "scheduleDatetime" => $smsItem->scheduleDatetime,
        "validityDatetime" => $smsItem->validityDatetime,
        "callbackUrl" => $smsItem->callbackUrl,
        "userData" => "",
        "visibleMessage" => $smsItem->visibleMessage,
        "nonce" => $smsItem->nonce);

        
        $url = 'https://www.web2sms.ro/prepaid/message';
        $ch = curl_init($url);
        
        $payload = json_encode($data); // json DATA
        // die($payload);

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set to include the header in the output.
        curl_setopt($ch, CURLOPT_HEADER, true);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-length: '.strlen($payload)));

        // Set the authorization signature
        curl_setopt($ch, CURLOPT_USERPWD, $this->apiKey . ":" . $signature);

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);
        
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK
                    $arr = array(
                        'status'  => 1,
                        'code'    => $http_code,
                        'msg'     => "SMS sent successfully",
                        'data'    => "".json_decode($result)
                    );
                break;
                case 404:  # Not Found 
                    $arr = array(
                        'status'  => 0,
                        'code'    => $http_code,
                        'msg'     => 'Not Found',
                        'data'    => json_decode($result)
                    );
                break;
                case 400:  # Bad Request
                    $arr = array(
                        'status'  => 0,
                        'code'    => $http_code,
                        'msg'     => 'Bad Request',
                        'data'    => json_decode($result)
                    );
                break;
                case 405:  # Method Not Allowed
                    $arr = array(
                        'status'  => 0,
                        'code'    => $http_code,
                        'msg'     => 'Method Not Allowed',
                        'data'    => json_decode($result)
                    );
                break;
                case 415:  # Unsupported Media Type.
                    $arr = array(
                        'status'  => 0,
                        'code'    => $http_code,
                        'msg'     => 'Unsupported Media Type.',
                        'data'    => json_decode($result)
                    );
                break;
                default:
                    $arr = array(
                        'status'  => 0,
                        'code'    => $http_code,
                        'msg'     => null,
                        'data'    => $http_code."_".json_decode($result)
                    );
                break;
            }
        } else {
            $arr = array(
                'status' => 0,
                'code'   => $http_code,
                'msg'    => null,
                'data'   => json_decode($result)
            );
        }
        
        // Close cURL resource
        curl_close($ch);
        
        $finalResult = json_encode($arr, JSON_FORCE_OBJECT);
        return $finalResult;
    }
}