<?php

namespace App\Controller;

use App\Entity\Message;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends AbstractController
{
    /**
     * @Route(name="get_messages",
     * path="api/messages",methods={"GET"},
     * defaults= {"_api_resource_class" : "App\Entity\Message","_api_collection_operation_name" : "get_messages"})
     */
    public function __invoke( ManagerRegistry $doctrine, Request $request)
    {
        $messages = $doctrine->getRepository(Message::class)->findMessages($request->query->get("sender"),$request->query->get("receiver"));
        return new ArrayCollection($messages);
    }
}
