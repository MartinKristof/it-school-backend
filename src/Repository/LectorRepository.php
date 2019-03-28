<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Lector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Lector|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lector|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lector[]    findAll()
 * @method Lector[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LectorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lector::class);
    }

    // /**
    //  * @return Lector[] Returns an array of Lector objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lector
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
