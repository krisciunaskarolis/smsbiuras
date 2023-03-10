# SmsBiuras.lt SMS gateway PHP integration

PHP client for [SmsBiuras](https://smsbiuras.lt) [sms sending API](https://docs.smsbiuras.lt/). 

Client allows sending sms messages.

## Getting Started
### Installation

```shell
composer require krisciunaskarolis/smsbiuras
```

### Authentication

You have to create SmsBiuras account first. More information [here](https://www.smsbiuras.lt/).
After registration you have to create APIKEY, which will be used for authentication.

### Sending messages
To send messages:

```php
$apiKey = '[API_KEY]'; //replace [API_KEY] with your API key
$userId = '[USER_ID]'; //replace [USER_ID] with your user id

$smsSender = new \Krisciunas\SmsBiuras\Sender\SmsSender();
$message = new \Krisciunas\SmsBiuras\Message\SmsMessage(
    //Sender name (sender ID), sender must be confirmed before sending SMS message
    sender: '37062415654',
    //Phone number of recipient
    recipientPhoneNumber: '37066666661',
    //Message
    message: 'This is test message for first recipient!',
    //Should message be opened on receiver's screen
    flash: \Krisciunas\SmsBiuras\Message\SmsMessageInterface::FLASH_NOT_REQUIRED,
    //Is it test message
    test: \Krisciunas\SmsBiuras\Message\SmsMessageInterface::TEST_MODE_ENABLED,
);

$result = $smsSender->send($apiKey, $userId, $message);
```

### Getting result

`send` method of `SmsSender` class returns object implementing `MessageLogRecordInterface`. 
You can use this object to check status of message sent:

```php
   $messageStatus = $result->getStatusCode();
   $messageId = $result->getMessageId();
```

If message was successfully sent, $messageId will be not null.
If error occured, $messageStatus will be the code of error.
Check [list of error codes here](https://docs.smsbiuras.lt/#klaidu_kodai)

## Examples

You can find working example in `src/examples/sendSmsMessages.php`

Replace `[API_KEY]`, `[USER_ID]` with yours and run example:

```
php sendSmsMessages.php
```

## Authors
- [Karolis Kriščiūnas](mailto:karolis.krisciunas@gmail.com)