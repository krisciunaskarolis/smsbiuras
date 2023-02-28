<?php

declare(strict_types=1);

namespace Sender;

use Krisciunas\BulkSms\Request\RequestBuilderInterface;
use Krisciunas\BulkSms\Sender\SmsSender;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;

class SmsSenderTest extends TestCase
{
    private SmsSender $smsSender;

    private ClientInterface & MockObject $clientMock;

    private RequestBuilderInterface & MockObject $requestBuilderMock;

    protected function setUp(): void
    {
        $this->clientMock = $this->createMock(ClientInterface::class);
        $this->requestBuilderMock = $this->createMock(RequestBuilderInterface::class);

        $this->smsSender = new SmsSender(
            $this->clientMock,
            $this->requestBuilderMock,
        );
    }

    public function testSend()
    {

    }
}
