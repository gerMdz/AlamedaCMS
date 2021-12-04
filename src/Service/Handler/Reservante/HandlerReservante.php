<?php

namespace App\Service\Handler\Reservante;

use App\Entity\Celebracion;
use App\Exception\Celebracion\CelebracionNotFoundException;
use App\Repository\CelebracionRepository;
use App\Repository\ReservanteRepository;

class HandlerReservante
{

    private $reservanteRepository;
    private $celebracionRepository;

    /**
     * @param ReservanteRepository $reservanteRepository
     * @param CelebracionRepository $celebracionRepository
     */
    public function __construct(ReservanteRepository $reservanteRepository, CelebracionRepository $celebracionRepository)
    {
        $this->reservanteRepository = $reservanteRepository;
        $this->celebracionRepository = $celebracionRepository;
    }



}