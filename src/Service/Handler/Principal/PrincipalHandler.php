<?php

namespace App\Service\Handler\Principal;

use App\Entity\Principal;

class PrincipalHandler
{

    public function agregaSecciones(Principal $principal, $secciones):void
    {
        foreach ($secciones as $seccion)
        {
            $principal->addSeccione($seccion);
        }

    }
}