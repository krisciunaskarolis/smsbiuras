<?php

namespace Krisciunas\SmsBiuras\Sender;

use Krisciunas\SmsBiuras\Exception\RuntimeException;
use Krisciunas\SmsBiuras\Message\SmsMessageInterface;
use Krisciunas\SmsBiuras\Response\MessageLogRecordInterface;
use Psr\Http\Client\ClientExceptionInterface;

interface SenderInterface
{
    public const DEFAULT_TIMEOUT = 10;

    /**
     * @throws ClientExceptionInterface
     * @throws RuntimeException
     */
    public function send(string $apiToken, string $userId, SmsMessageInterface $message): MessageLogRecordInterface;
}
