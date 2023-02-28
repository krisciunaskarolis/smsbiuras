<?php

declare(strict_types=1);

namespace Krisciunas\SmsBiuras\Request;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Krisciunas\SmsBiuras\Message\SmsMessageInterface;
use Psr\Http\Message\RequestInterface;

class SmsSendingRequestBuilder implements RequestBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function build(string $apiToken, string $userId, SmsMessageInterface $message): RequestInterface
    {
        $uri = new Uri(self::ACTION);

        return new Request(
            self::METHOD,
            Uri::withQueryValues($uri, $this->getQuery($apiToken, $userId, $message)),
        );
    }

    private function getQuery(string $apiToken, string $userId, SmsMessageInterface $message): array
    {
        $data = [
            'uid' => $userId,
            'apikey' => $apiToken,
            'from' => $message->getSender(),
            'to' => $message->getRecipientPhoneNumber(),
            'message' => $message->getMessage(),
            'test' => $message->getTest(),
            'validity' => $message->getValidity(),
        ];

        if ($message->getSchedule()) {
            $data['schedule'] = $message->getSchedule();
        }

        return $data;
    }
}
