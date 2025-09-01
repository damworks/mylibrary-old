<?php

namespace App\Controller;

use Pimcore\Bundle\ApplicationLoggerBundle\ApplicationLogger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    #[Route('/health_check', name: 'app_health_check', methods: ['GET'])]
    public function __invoke(
        Request $request,
        ApplicationLogger $applicationLogger
    ): JsonResponse
    {
        $ip = $request->getClientIp();
        $applicationLogger->info('Health check endpoint from IP: ' . $ip);
        //$applicationLogger->error('ERROR');
        //$applicationLogger->debug('Test Debug', ['debugTest'=>'debugValue']);
        return $this->json(['status' => 'ok']);
    }
}
