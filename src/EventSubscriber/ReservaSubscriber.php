<?php

namespace App\EventSubscriber;

use App\Service\Handler\Celebracion\HandlerCelebracion;
use App\Service\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ReservaSubscriber implements EventSubscriberInterface
{
    private $handlerCelebracion;
    private $mailer;

    /**
     * ReservaSubscriber constructor.
     * @param HandlerCelebracion $handlerCelebracion
     * @param Mailer $mailer
     */
    public function __construct(HandlerCelebracion $handlerCelebracion, Mailer $mailer)
    {
        $this->handlerCelebracion = $handlerCelebracion;
        $this->mailer = $mailer;
    }

    public function onAnulaReservaEvent($event)
    {
//        $this->handlerCelebracion->hayLugar($event->getData());
        $this->handlerCelebracion->theWaitingList($event->getData());

        if($this->handlerCelebracion->hayLugar($event->getData())){
            $this->handlerCelebracion->theWaitingList($event->getData());
            try {
                $this->mailer->sendAvisoLugarMessage();
            } catch (TransportExceptionInterface $e) {

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
