<?php

declare(strict_types=1);

namespace Krisciunas\SmsBiuras\Response;

class MessageLogRecord implements MessageLogRecordInterface
{
    public function __construct(
        private readonly ?int $messageId,
        private readonly ?int $statusCode,
    ) {
    }

    public function getMessageId(): ?int
    {
        return $this->messageId;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }
}
