<?php

namespace App\Subscribers;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Course;
use App\Entity\User;
use App\Repository\StudentRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class StudentSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /** @var StudentRepository */
    private $studentRepository;

    public function __construct(TokenStorageInterface $tokenStorage, StudentRepository $studentRepository)
    {
        $this->tokenStorage = $tokenStorage;
        $this->studentRepository = $studentRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['handleCourseRequest', EventPriorities::POST_VALIDATE],
        ];
    }

    public function handleCourseRequest(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();
        $route = $request->get('_route');
        $entity = $event->getControllerResult();
        $method = $request->getMethod();

        if (!in_array($method, [Request::METHOD_GET]) ||
            in_array($request->getContentType(), ['html', 'form']) ||
            substr($route, 0, 3) !== 'api') {

            return;
        }

        $token = $this->tokenStorage->getToken();

        if ($token === null) {
            return;
        }

        /** @var User $author */
        $author = $token->getUser();

        if ($entity instanceof Course) {
            $entity->setFavorite($this->studentRepository->hasCourseFavorite($author->getId(), $entity->getId()));
        }
    }
}
