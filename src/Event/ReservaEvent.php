<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class ReservaEvent extends Event
{
    final public const ANULA_RESERVA = 'anula.reserva.event';

    public function __construct(protected $data)
    {
    }

    public function getData()
    {
        return $this->data;
    }
}
