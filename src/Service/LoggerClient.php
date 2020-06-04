<?php


namespace App\Service;

use App\Helper\LoggerTait;
use Psr\Log\LoggerInterface;

class LoggerClient
{

    use LoggerTait;



    /**
     * @param string $context|null
     * @param string $message
     */
    public function logMessage(string $message, string $context )
    {
        $this->logInfo('Edit Entrada', [
            'message' => $message
        ]);
    }


}
