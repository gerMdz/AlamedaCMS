<?php

namespace App\Service;

use App\Helper\LoggerTait;

class LoggerClient
{
    use LoggerTait;

    /**
     * @param string $context|null
     */
    public function logMessage(string $message, string $context)
    {
        $this->logInfo('Edit Entrada', [
            'message' => $message,
        ]);
    }
}
