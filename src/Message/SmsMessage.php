<?php

declare(strict_types=1);

namespace Krisciunas\SmsBiuras\Message;

use DateTimeInterface;
use Krisciunas\SmsBiuras\Exception\RuntimeException;

class SmsMessage implements SmsMessageInterface
{
    /**
     * @throws RuntimeException
     */
    public function __construct(
        private readonly string $sender,
        private readonly string $recipientPhoneNumber,
        private readonly string $message,
        private readonly int $flash = self::FLASH_NOT_REQUIRED,
        private readonly int $test = self::TEST_MODE_DISABLED,
        private readonly ?int $validity = 60,
        private readonly ?DateTimeInterface $schedule = null,
    ) {
        if (!in_array($this->flash, [self::FLASH_NOT_REQUIRED, self::FLASH_REQUIRED])) {
            throw new RuntimeException('Flash value is not supported. Allowed values are 0,1');
        }

        if (!in_array($this->test, [self::TEST_MODE_DISABLED, self::TEST_MODE_ENABLED])) {
            throw new RuntimeException('Test value is not supported. Allowed values are 0,1');
        }
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function getRecipientPhoneNumber(): string
    {
        return $this->recipientPhoneNumber;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTest(): int
    {
        return $this->test;
    }

    public function getValidity(): ?int
    {
        return $this->validity;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule?->format(self::DATE_FORMAT);
    }

    public function getFlash(): int
    {
        return $this->flash;
    }
}
