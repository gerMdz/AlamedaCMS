<?php


namespace App\Event;


use Symfony\Contracts\EventDispatcher\Event;

class ClonePrincipalEvent extends Event
{
    public const CLONE_PRINCIPAL = 'clone-principal.event';

    protected $data;
    protected $principal;
    protected $secciones;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * @param mixed $principal
     */
    public function setPrincipal($principal): void
    {
        $this->principal = $principal;
    }

    /**
     * @return mixed
     */
    public function getSecciones()
    {
        return $this->secciones;
    }

    /**
     * @param mixed $secciones
     */
    public function setSecciones($secciones): void
    {
        $this->secciones = $secciones;
    }


}