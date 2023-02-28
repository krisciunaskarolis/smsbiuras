<?php

namespace Krisciunas\SmsBiuras\Request;

use Krisciunas\SmsBiuras\Message\SmsMessageInterface;
use Psr\Http\Message\RequestInterface;

interface RequestBuilderInterface
{
    public const ACTION = 'https://savitarna.smsbiuras.lt/api';
    public const METHOD = 'GET';

    public function build(string $apiToken, string $userId, SmsMessageInterface $message): RequestInterface;
}
