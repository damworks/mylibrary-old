<?php

namespace App\Controller;

use App\Message\TestMessage;
use DateTimeImmutable;
use Pimcore\Bundle\ApplicationLoggerBundle\ApplicationLogger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class QueueTestController extends AbstractController
{
    #[Route('/api/queue/test', methods: ['POST'])]
    public function enqueue(
        Request $request,
        MessageBusInterface $bus,
        ApplicationLogger $appLogger
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $payload = (string)($data['payload'] ?? 'empty');

        $requestedAt = new DateTimeImmutable('now');
        $requestedAtIso = $requestedAt->format(DATE_ATOM);

        $bus->dispatch(new TestMessage($payload, $requestedAtIso));

        //$bus->dispatch(new TestMessage($payload, $requestedAtIso),
        //    [new TransportNamesStamp(['testAsyncQueue'])]
        //);

        // Log API enqueue
        $appLogger->info('API enqueue', [
            'component'    => 'test_async_queue',
            'requested_at' => $requestedAtIso,
            'payload'      => $payload,
        ]);

        return new JsonResponse([
            'queued'       => true,
            'requested_at' => $requestedAtIso,
        ], 202);
    }
}
