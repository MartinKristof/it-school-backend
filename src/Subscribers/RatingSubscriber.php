<?php

namespace App\Subscribers;

use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RatingSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['handleRatingRequest', EventPriorities::POST_DESERIALIZE],
        ];
    }

    public function handleRatingRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $route = $request->get('_route');
        $method = $request->getMethod();

        if (!in_array($method, [Request::METHOD_POST]) ||
            in_array($request->getContentType(), ['html', 'form']) ||
            substr($route, 0, 3) !== 'api') {

            return;
        }
    }
}
