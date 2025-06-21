<?php

namespace App\Service;

use App\Helper\LoggerTrait;

class LoggerClient
{
    use LoggerTrait;

    /**
     * Log a message with context
     */
    public function logMessage(string $message, string $context, string $level = 'info'): void
    {
        $contextArray = [
            'message' => $message,
            'context' => $context,
        ];

        switch ($level) {
            case 'debug':
                $this->logDebug($message, $contextArray);
                break;
            case 'notice':
                $this->logNotice($message, $contextArray);
                break;
            case 'warning':
                $this->logWarning($message, $contextArray);
                break;
            case 'error':
                $this->logError($message, $contextArray);
                break;
            case 'critical':
                $this->logCritical($message, $contextArray);
                break;
            case 'alert':
                $this->logAlert($message, $contextArray);
                break;
            case 'emergency':
                $this->logEmergency($message, $contextArray);
                break;
            case 'info':
            default:
                $this->logInfo($message, $contextArray);
                break;
        }
    }
}
