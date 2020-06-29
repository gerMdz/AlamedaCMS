<?php

namespace App\Service;

use DateTime;

class BoleanToDateHelper
{
    private $boolean;

    public function setDatatimeForTrue(bool $boolean): ?DateTime
    {
        if (true == $boolean) {
            return new DateTime('now');
        }

        return null;
    }
}
