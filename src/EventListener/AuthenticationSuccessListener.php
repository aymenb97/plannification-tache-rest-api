<?php

namespace  App\EventListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param AuthenticationSuccessEvent   $event
     *
     * @return void
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent   $event)
    {

        $data = $event->getData();
        $user= $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }
        $data["surname"]=$user->getSurname();
        $data["name"]=$user->getName();



        $event->setData($data);



    }
}