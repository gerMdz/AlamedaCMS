<?php

namespace App\Helper;

use Psr\Log\LoggerInterface;

trait LoggerTait
{
    /**
     * @var LoggerInterface|null
     */
    private $logger;

    #[\Symfony\Contracts\Service\Attribute\Required]
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function logInfo(string $message, array $context = [])
    {
        if ($this->logger) {
            $this->logger->info($message, $context);
        }
    }
}
