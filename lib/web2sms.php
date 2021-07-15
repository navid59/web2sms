<?php
abstract class Web2sms {
    // Error code defination
    const INTERNAL_WEB2SMS_ERROR                                = 0x20000001; // 536870913 -> Internal web2SMS error 
    const NO_AVAILABLE_ACCOUNT_FOR_THE_CALLING_IP               = 0x10000001; // 268435457 -> No available account for the calling IP                             
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
    
    public $apiKey;
    public $secretKey;
    public $username;
    public $message;


    // "nonce" => time() // Current LINUX Timestamp
    public function __construct(){
        //
    }
    
    // Send request json to SMS
    public function sendRequest($jsonStr) {
        if(!isset($this->apiKey) || is_null($this->apiKey)) {
            throw new \Exception('INVALID_APIKEY');
            exit;
        }

        echo "<pre>";
        die(print_r($jsonStr));

        $url = 'https://www.web2sms.ro/prepaid/message';
        $ch = curl_init($url);
        
        $payload = $jsonStr; // json DATA

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type : application/json'));
        
        // Set the authorization info
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->apiKey);

        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);
        
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK
                    $arr = array(
                        'status'  => 1,
                        'data'    => json_decode($result)
                    );
                break;
                case 404:  # Not Found 
                    $arr = array(
                        'status'  => 0,
                        'data'    => json_decode($result)
                    );
                break;
                case 400:  # Bad Request
                    $arr = array(
                        'status'  => 0,
                        'data'    => json_decode($result)
                    );
                break;
                case 405:  # Method Not Allowed
                    $arr = array(
                        'status'  => 0,
                        'data'    => json_decode($result)
                    );
                break;
                default:
                    $arr = array(
                        'status'  => 0,
                        'data'    => json_decode($result)
                    );
                break;
            }
        } else {
            $arr = array(
                'status'  => 0,
                'message' => "Opps! There is some problem, you are not able to send data!!!"
            );
        }
        
        // Close cURL resource
        curl_close($ch);
        
        $finalResult = json_encode($arr, JSON_FORCE_OBJECT);
        return $finalResult;
    }
}