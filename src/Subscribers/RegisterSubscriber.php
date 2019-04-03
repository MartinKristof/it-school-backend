<?php

namespace App\Subscribers;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Student;
use App\Entity\User;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Ramsey\Uuid\Uuid;

class RegisterSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /** @var StudentRepository */
    private $studentRepository;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        StudentRepository $studentRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->studentRepository = $studentRepository;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['handleGenerateToken', EventPriorities::PRE_WRITE],
                ['handlePostRequest', EventPriorities::POST_WRITE],
            ],
        ];
    }

    public function handleGenerateToken(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();
        $route = $request->get('_route');
        $entity = $event->getControllerResult();
        $method = $request->getMethod();

        if (!in_array($method, [Request::METHOD_POST]) ||
            in_array($request->getContentType(), ['html', 'form']) ||
            substr($route, 0, 3) !== 'api') {

            return;
        }

        if ($entity instanceof User) {
            $entity->setApiKey(Uuid::uuid4());
        }
    }

    public function handlePostRequest(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();
        $route = $request->get('_route');
        $entity = $event->getControllerResult();
        $method = $request->getMethod();

        if (!in_array($method, [Request::METHOD_POST]) ||
            in_array($request->getContentType(), ['html', 'form']) ||
            substr($route, 0, 3) !== 'api') {

            return;
        }

        if ($entity instanceof User) {
            $student = new Student($entity);

            $this->entityManager->persist($student);
            $this->entityManager->flush();
        }
    }
}
