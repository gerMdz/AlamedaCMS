<?php

namespace App\Helper;

use Psr\Log\LoggerInterface;

trait LoggerTrait
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

    /**
     * Log a debug message
     */
    public function logDebug(string $message, array $context = []): void
    {
        if ($this->logger) {
            $this->logger->debug($message, $context);
        }
    }

    /**
     * Log an info message
     */
    public function logInfo(string $message, array $context = []): void
    {
        if ($this->logger) {
            $this->logger->info($message, $context);
        }
    }

    /**
     * Log a notice message
     */
    public function logNotice(string $message, array $context = []): void
    {
        if ($this->logger) {
            $this->logger->notice($message, $context);
        }
    }

    /**
     * Log a warning message
     */
    public function logWarning(string $message, array $context = []): void
    {
        if ($this->logger) {
            $this->logger->warning($message, $context);
        }
    }

    /**
     * Log an error message
     */
    public function logError(string $message, array $context = []): void
    {
        if ($this->logger) {
            $this->logger->error($message, $context);
        }
    }

    /**
     * Log a critical message
     */
    public function logCritical(string $message, array $context = []): void
    {
        if ($this->logger) {
            $this->logger->critical($message, $context);
        }
    }

    /**
     * Log an alert message
     */
    public function logAlert(string $message, array $context = []): void
    {
        if ($this->logger) {
            $this->logger->alert($message, $context);
        }
    }

    /**
     * Log an emergency message
     */
    public function logEmergency(string $message, array $context = []): void
    {
        if ($this->logger) {
            $this->logger->emergency($message, $context);
        }
    }
}
