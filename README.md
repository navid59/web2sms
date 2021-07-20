<div align="center"><a href="https://www.web2sms.ro"><img alt="Parsedown" src="https://www.web2sms.ro/assets/themes/public/images/front/logo.png" /></a></div>

# WEB2SMS SRL
## WEB2SMS Composer

### Installation
Run the following command from root of your project 
* <code>composer require web2sms/xxx</code>
#### or 
* add the **"web2sms/xxx"** to your **composer.json** file like the following example
    <code>

        "require": {
            ...
            "web2sms/xxx": "^1.0",
            ...
        }

    </code>
    and then run the following command from your Terminal
    
    <code>composer install</code>
    
### Example    

##### An example of Send SMS in Laravel 
<code>
    ```php
    ...
    
    require_once('lib/sendSMS.php');
    use Web2sms\sendSMS;

    $sendSMS = new sendSMS();

    $sendSMS->apiKey    = 'API_KEY_FROM_THE_PLATFORM'; 
    $sendSMS->secretKey = 'SECRET_KEY_FROM_THE_PLATFORM';

    // SMS #1
    $sendSMS->messages[]  = [
                        'sender'            => ''          ,            // who send the SMS             // Optional
                        'recipient'         => '07XXXXXXXX',            // who recive the SMS           // Mandatory
                        'body'              => 'This is the actual content of SMS nr one',              // Mandatory
                        'scheduleDatetime'  => 'YYYY-MM-DD 00:00:00',   // Data & Time to send SMS      // Optional
                        'validityDatetime'  => null,                    // Data & Time of expire SMS    // Optional
                        'callbackUrl'       => 'YOUR_DOMAIN/PAGE_URL',  // Full callback URL            // Optional    
                        'userData'          => null,                    // User data                    // Optional
                        'visibleMessage'    => false                    // false / True                 // Optional
                        ];

    ...

    // SMS #N
    $sendSMS->messages[]  = [
                        'sender'            => ''          ,            // who send the SMS             // Optional
                        'recipient'         => '07XXXXXXXX',            // who recive the SMS           // Mandatory
                        'body'              => 'This is the actual content of SMS nr N'                 // Mandatory
                        'scheduleDatetime'  => null,                    // Data & Time to send SMS      // Optional
                        'validityDatetime'  => null,                    // Data & Time of expire SMS    // Optional
                        'callbackUrl'       => 'YOUR_DOMAIN/PAGE_URL',  // Full callback URL            // Optional    
                        'userData'          => null,                    // User data                    // Optional
                        'visibleMessage'    => false                    // false / True                 // Optional
                        ];


    $sendSMS->setRequest();
    $sendSMS->sendSMS();

    ...
    ```
</code>