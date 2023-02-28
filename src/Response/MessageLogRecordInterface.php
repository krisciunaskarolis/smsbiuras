<?php

namespace Krisciunas\SmsBiuras\Response;

interface MessageLogRecordInterface
{
    public function getMessageId(): ?int;

    public function getStatusCode(): ?int;
}
