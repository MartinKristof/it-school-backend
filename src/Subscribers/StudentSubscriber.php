<?php

namespace App\Subscribers;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Course;
use App\Entity\Lector;
use App\Entity\User;
use App\Repository\LectorRepository;
use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
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

    /** @var LectorRepository */
    private $lectorRepository;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        StudentRepository $studentRepository,
        LectorRepository $lectorRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->studentRepository = $studentRepository;
        $this->lectorRepository = $lectorRepository;
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

        /** @var User $user */
        $user = $token->getUser();

        foreach ($entity as $instance) {
            if ($instance instanceof Course) {
                $this->addCourseData($user, $instance);
            }
        }

        if ($entity instanceof Course) {
            $this->addCourseData($user, $entity);
        }
    }

    private function addCourseData(User $user, Course $instance)
    {
        $studentId = $this->studentRepository->getStudentIdByUserId($user->getId());
        $instance->setFavorite($this->studentRepository->hasCourseFavorite($studentId, $instance->getId()));
        /** @var Lector[] $lectors */
        $lectors = $this->lectorRepository->findLectorsForCourseById($instance->getId());
        $instance->setLectors(new ArrayCollection($lectors));
    }
}
