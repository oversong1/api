<?php

namespace App\EventSubscriber;

use App\Entity\Produtos;
use ApiPlatform\Symfony\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;;

class UserSubscriber implements EventSubscriberInterface
{
    public function onUserView(ViewEvent $event): void
    {
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if(! $entity instanceof Produtos || (Request::METHOD_POST !== $method)){
            return ;
        }
        $entity->setUserId(10);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['onUserView', EventPriorities::PRE_WRITE],
        ];
    }
}