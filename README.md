<div align="center"><a href="https://www.web2sms.ro"><img alt="Parsedown" src="https://www.web2sms.ro/assets/themes/public/images/front/logo.png" /></a></div>

# WEB2SMS SRL
### WEB2SMS Composer

## Introduction

The WEB2SMS PHP library provides easy access to the send SMS via WEB2SMS API from any
applications written in the PHP language.

## Requirements
PHP 5.7.0 and later.

## Compatibility
PHP 8.0.8

## Installation 

You can install the library via [Composer](http://getcomposer.org/). Run the following command:

```
    composer web2sms
```

### API URL
<https://www.web2sms.ro/prepaid/message/>


### Actions
* #### **Send SMS**
        
    To send one / a set of **SMS** ,

    * **Action URL:** /prepaid/message/
    * **Method:** `POST`    
    
        
    #### An example

    ```php
        ...
        
        require_once('lib/sendSMS.php');
        use Web2sms\sendSMS;

        $sendSMS = new sendSMS();

        $sendSMS->apiKey    = 'API_KEY_FROM_THE_PLATFORM'; 
        $sendSMS->secretKey = 'SECRET_KEY_FROM_THE_PLATFORM';

        // SMS #1
        $sendSMS->messages[]  = [
                            'sender'            => ''          ,          // who send the SMS             // Optional
                            'recipient'         => '07XXXXXXXX',          // who recive the SMS           // Mandatory
                            'body'              => 'This is the actual content of SMS nr one',            // Mandatory
                            'scheduleDatetime'  => 'YYYY-MM-DD 00:00:00', // Data & Time to send SMS      // Optional
                            'validityDatetime'  => null,                  // Data & Time of expire SMS    // Optional
                            'callbackUrl'       => 'DOMAIN/XXX/',         // Full callback URL            // Optional    
                            'userData'          => null,                  // User data                    // Optional
                            'visibleMessage'    => false                  // false / True                 // Optional
                            ];

        ...

        // SMS #N
        $sendSMS->messages[]  = [
                            'sender'            => ''          ,          // who send the SMS             // Optional
                            'recipient'         => '07XXXXXXXX',          // who recive the SMS           // Mandatory
                            'body'              => 'This is the actual content of SMS nr N'               // Mandatory
                            'scheduleDatetime'  => null,                  // Data & Time to send SMS      // Optional
                            'validityDatetime'  => null,                  // Data & Time of expire SMS    // Optional
                            'callbackUrl'       => 'DOMAIN/XXX/',         // Full callback URL            // Optional    
                            'userData'          => null,                  // User data                    // Optional
                            'visibleMessage'    => false                  // false / True                 // Optional
                            ];


        $sendSMS->setRequest();
        $sendSMS->sendSMS();

        ...
    ```

### Error codes defination

    * **536870913** -> Internal web2SMS error 
    * **268435457** -> No available account for the calling IP                             
    * **268435463** -> Associated account is disabled  
    * **268435462** -> Associated account is missconfigured                                  
    * **268435464** -> Internal web2SMS error while creating SMS Sender                                   
    * **268435458** -> Parameter `phone` has a wrong format or it belongs to a GSM.Network that is not configured for the associated account!                                               
         
    * **268435466** -> Phone number is black listed
    * **268435520** -> Phone number belongs to a GSN Network that is not configured for the associated account 
    * **268435460** -> You’ve exceeded your monthly limit for SMS sending
    * **268435488** -> You are trying to schedule a SMS message outside the configured time interval restrictions
    * **268435459** -> Parameter `message` is empty! Empty message are not allowed 
    * **268435465** -> Internal web2SMS error while scheduling a SMS


##### When / Why send SMS
Now days sending SMS to the customers helping any business to increase customers retention.

Also, can can benefit of sending SMS in other scenarios as well
For example :
    * For phone verification of your app / site members
    * To 2-Step verification
    * To notify / reminding of an event
    * Etc 

##### Resources
###### ( <a href="https://sites.google.com/a/netopia-system.com/wiki-web2sms/api-web2sms-rest-client" target="_blank">WEB2SMS Documentation</a> )