<?php

namespace App\EventListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event)
    {

        $payload= $event->getData();
        $payload["mercure"]=["publish"=>["*"],"subscribe"=>["*"]];
        $event->setData($payload);
    }

}