<?php

namespace App\Command;

use Pimcore\Bundle\ApplicationLoggerBundle\ApplicationLogger;
use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Elements\Bundle\ProcessManagerBundle\ExecutionTrait;

class TestProcessCommand extends AbstractCommand
{
    use ExecutionTrait;
    /*
     * This is a simple command to test the Process Manager functionality.
     * It sleeps for 2 seconds to simulate a long-running process.
     *
     */
    /**
     * @param ApplicationLogger $applicationLogger
     */
    public function __construct(
        private readonly ApplicationLogger $applicationLogger,
    ) {
        parent::__construct();
    }

     protected function configure(): void
    {
        $this
            ->setName('app:test-process')
            ->setDescription('Test command for Process Manager');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = microtime(true);
        $output->writeln('Process Manager works!');

        sleep(2);

        $output->writeln('Completed.');
        $end = microtime(true);
        $this->applicationLogger->info(
            sprintf('Process "app:test-process" completed in %.3f seconds', $end - $start),
            ['component' => 'process_manager']
        );
        return self::SUCCESS;
    }
}
