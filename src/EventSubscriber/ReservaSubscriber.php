<?php

namespace App\EventSubscriber;

use App\Service\Handler\Celebracion\HandlerCelebracion;
use App\Service\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ReservaSubscriber implements EventSubscriberInterface
{
    /**
     * ReservaSubscriber constructor.
     */
    public function __construct(private HandlerCelebracion $handlerCelebracion, private Mailer $mailer)
    {
    }

    public function onAnulaReservaEvent($event)
    {
        if ($this->handlerCelebracion->hayLugar($event->getData())) {
            try {
                $this->mailer->sendAvisoLugarMessage($event->getData());
            } catch (TransportExceptionInterface) {
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'anula.reserva.event' => 'onAnulaReservaEvent',
        ];
    }
}
