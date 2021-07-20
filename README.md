<div align="center"><a href="https://www.web2sms.ro"><img alt="Parsedown" src="https://www.web2sms.ro/assets/themes/public/images/front/logo.png" /></a></div>

# WEB2SMS SRL
### WEB2SMS Composer

## Introduction

The WEB2SMS PHP library provides easy access to the send SMS via WEB2SMS API from any
applications written in the PHP language.

## Requirements
PHP 5.7.0 and later.

## Installation 

You can install the library via [Composer](http://getcomposer.org/). Run the following command:

    ```bash
    composer XXXXXXXXXXXX
    ```

### API URL
<https://www.web2sms.ro/prepaid/message/>


### Actions
* #### ** Send SMS**
        
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
                            'body'              => 'This is the actual content of SMS nr one',              // Mandatory
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
                            'body'              => 'This is the actual content of SMS nr N'                 // Mandatory
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

##### Resources
###### ( <a href="https://sites.google.com/a/netopia-system.com/wiki-web2sms/api-web2sms-rest-client" target="_blank">WEB2SMS Documentation</a> )