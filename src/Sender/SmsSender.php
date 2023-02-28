<?php

declare(strict_types=1);

namespace Krisciunas\SmsBiuras\Sender;

use GuzzleHttp\Client;
use Krisciunas\SmsBiuras\Exception\RuntimeException;
use Krisciunas\SmsBiuras\Message\SmsMessageInterface;
use Krisciunas\SmsBiuras\Request\RequestBuilderInterface;
use Krisciunas\SmsBiuras\Request\SmsSendingRequestBuilder;
use Krisciunas\SmsBiuras\Response\MessageLogRecord;
use Krisciunas\SmsBiuras\Response\MessageLogRecordInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class SmsSender implements SenderInterface
{
    public function __construct(
        private ?ClientInterface $client = null,
        private ?RequestBuilderInterface $requestBuilder = null
    ) {
        if (null === $this->client) {
            $this->client = new Client(['timeout' => self::DEFAULT_TIMEOUT]);
        }

        if (null === $this->requestBuilder) {
            $this->requestBuilder = new SmsSendingRequestBuilder();
        }
    }

    /**
     * @inheritDoc
     */
    public function send(string $apiToken, string $userId, SmsMessageInterface $message): MessageLogRecordInterface
    {
        if (!$this->requestBuilder || !$this->client) {
            throw new RuntimeException('SmsBiuras request builder and client is required to send sms');
        }

        $request = $this->requestBuilder->build($apiToken, $userId, $message);
        $response = $this->client->sendRequest($request);

        return $this->parseResponse($response);
    }

    private function parseResponse(ResponseInterface $response): MessageLogRecordInterface
    {
        $response = $response->getBody()->getContents();

        if (str_starts_with($response, 'OK: ')) {
            $messageId = str_replace('OK: ', '', $response);

            return new MessageLogRecord((int) $messageId, null);
        }

        if (str_starts_with($response, 'ERROR:')) {
            $errorCode = str_replace('ERROR: ', '', $response);

            return new MessageLogRecord(null, (int)$errorCode);
        }

        throw new RuntimeException('Unknown response got.');
    }
}
