<?php

namespace App\Message;

class TestMessage
{
    public function __construct(
        private string $payload,
        private string $requestedAtIso // ISO8601: es. 2025-09-14T19:20:30+00:00
    ) {}

    public function getPayload(): string { return $this->payload; }
    public function getRequestedAtIso(): string { return $this->requestedAtIso; }
}
