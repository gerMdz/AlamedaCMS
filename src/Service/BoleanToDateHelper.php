<?php

namespace App\Service;

class BoleanToDateHelper
{
    private $boolean;

    public function setDatatimeForTrue(bool $boolean): ?\DateTime
    {
        if (true == $boolean) {
            return new \DateTime('now');
        }

        return null;
    }
}
