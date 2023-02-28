<?php

require '../../vendor/autoload.php';

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

$result = $smsSender->send($apiKey, $userId, $message); //replace [API_KEY] with your API key

$messageStatus = $result->getStatusCode(); //null if message is successfully sent.
$messageId = $result->getMessageId();
