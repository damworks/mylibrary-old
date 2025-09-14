<?php

namespace App\MessageHandler;

use App\Message\TestMessage;
use DateTimeImmutable;
use Pimcore\Bundle\ApplicationLoggerBundle\ApplicationLogger;
use Pimcore\Bundle\ApplicationLoggerBundle\FileObject;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class TestMessageHandler
{
    public function __construct(private ApplicationLogger $appLogger) {}

    public function __invoke(TestMessage $message): void
    {
        // Simulates a time-consuming process (e.g., external API call, data processing, etc.)
        sleep(5);

        $requestedAt = new DateTimeImmutable($message->getRequestedAtIso());
        $processedAt = new DateTimeImmutable('now');
        $latencySec  = $processedAt->getTimestamp() - $requestedAt->getTimestamp();

        $data = [
            'requested_at' => $requestedAt->format(DATE_ATOM),
            'processed_at' => $processedAt->format(DATE_ATOM),
            'latency_sec'  => $latencySec,
            'payload'      => $message->getPayload(),
        ];

        $this->appLogger->info('Processing finished', [
            'component'     => 'test_async_queue',
            'requested_at'  => $data['requested_at'],
            'processed_at'  => $data['processed_at'],
            'latency_sec'   => $data['latency_sec'],
            'payload'       => $data['payload'],
            // attach a JSON file for easy reference
            'fileObject' => new FileObject(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)),
            ]);
    }
}
