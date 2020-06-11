<?php

namespace App\Repository;

use App\Entity\Reponsetab;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reponsetab|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reponsetab|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reponsetab[]    findAll()
 * @method Reponsetab[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponsetabRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reponsetab::class);
    }

    // /**
    //  * @return Reponsetab[] Returns an array of Reponsetab objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reponsetab
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
