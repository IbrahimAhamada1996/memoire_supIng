<?php

namespace App\Repository;

use App\Entity\SeuilTransfert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SeuilTransfert|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeuilTransfert|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeuilTransfert[]    findAll()
 * @method SeuilTransfert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeuilTransfertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeuilTransfert::class);
    }

    // /**
    //  * @return SeuilTransfert[] Returns an array of SeuilTransfert objects
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
    public function findOneBySomeField($value): ?SeuilTransfert
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
