<?php

require '../../vendor/autoload.php';

$apiKey = 'KzM3MDYyNDE1NjU0OjkyMDM0NTExN0QxQkNBNA==';
$userId = '3023';

$smsSender = new \Krisciunas\SmsBiuras\Sender\SmsSender();
$message = new \Krisciunas\SmsBiuras\Message\SmsMessage(
    sender: '37062415654',
    //Sender name (sender ID), sender must be confirmed before sending SMS message
    recipientPhoneNumber: '37066666661',
    //Phone number of recipient
    message: 'This is test message for first recipient!',
    //Message
    flash: \Krisciunas\SmsBiuras\Message\SmsMessageInterface::FLASH_NOT_REQUIRED,
    //Should message be opened on receiver's screen
    test: \Krisciunas\SmsBiuras\Message\SmsMessageInterface::TEST_MODE_ENABLED, //Is it test message
);

$result = $smsSender->send($apiKey, $userId, $message); //replace [API_KEY] with your BulkSMS API key

$messageStatus = $result->getStatusCode();
$messageId = $result->getMessageId();

