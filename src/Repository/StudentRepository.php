<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Student::class);
    }

    public function getStudentIdByUserId(int $userId): int
    {
        return (int) $this->createQueryBuilder('s')
            ->select('s.id')
            ->andWhere('s.user = :userId')
            ->setParameters(['userId' => $userId])
            ->setMaxResults(10)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function hasCourseFavorite(int $studentId, int $courseId): bool
    {
        return $this->createQueryBuilder('s')
                ->select('count(c.id)')
                ->join('s.favoriteCourses', 'c')
                ->andWhere('s.id = :studentId')
                ->andWhere('c.id = :courseId')
                ->setParameters(['studentId' => $studentId, 'courseId' => $courseId])
                ->orderBy('s.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
