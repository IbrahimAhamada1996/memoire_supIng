<?php

namespace App\Repository;

use App\Entity\EtatRetrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtatRetrait|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatRetrait|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatRetrait[]    findAll()
 * @method EtatRetrait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatRetraitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatRetrait::class);
    }

    // /**
    //  * @return EtatRetrait[] Returns an array of EtatRetrait objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtatRetrait
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
