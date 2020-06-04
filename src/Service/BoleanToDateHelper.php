<?php


namespace App\Service;



use DateTime;

class BoleanToDateHelper
{

    private $boolean;

    public function setDatatimeForTrue(bool $boolean): ?DateTime
    {
        if($boolean == true){
            return new DateTime('now');
        }

        return null;
    }
}
