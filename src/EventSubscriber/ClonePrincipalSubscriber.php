<?php

namespace App\EventSubscriber;

use App\Event\ClonePrincipalEvent;
use App\Service\Handler\Principal\PrincipalHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClonePrincipalSubscriber implements EventSubscriberInterface
{



    public function onClonePrincipalEvent(ClonePrincipalEvent $event)
    {
        $principalHandler = new PrincipalHandler();
        $principalHandler->agregaSecciones($event->getData(), $event->getSecciones());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'clone-principal.event' => 'onClonePrincipalEvent',
        ];
    }
}
