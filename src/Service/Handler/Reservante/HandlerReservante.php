<?php

namespace App\Service\Handler\Reservante;

use App\Entity\Celebracion;
use App\Entity\Reservante;
use App\Repository\CelebracionRepository;
use App\Repository\ReservanteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use stdClass;

class HandlerReservante
{

    private $reservanteRepository;
    private $celebracionRepository;
    private $entityManager;

    /**
     * @param ReservanteRepository $reservanteRepository
     * @param CelebracionRepository $celebracionRepository
     * @param EntityManager $entityManager
     */
    public function __construct(
        ReservanteRepository $reservanteRepository,
        CelebracionRepository $celebracionRepository,
        EntityManagerInterface $entityManager
    )
    {
        $this->reservanteRepository = $reservanteRepository;
        $this->celebracionRepository = $celebracionRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ORMException
     */
    public function saveReservante(Celebracion $celebracion, stdClass $data): Reservante
    {
        $reservante = new Reservante();
        $reservante->setCelebracion($celebracion);
        $reservante->setEmail($data->email);
        $reservante->setApellido($data->apellido);
        $reservante->setNombre($data->nombre);
        $reservante->setTelefono($data->telefono);
        $this->entityManager->persist($reservante);
        $this->entityManager->flush();
        return $reservante;
    }



}