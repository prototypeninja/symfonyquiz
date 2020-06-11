<?php

namespace App\Repository;

use App\Entity\Questiontab;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Questiontab|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questiontab|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questiontab[]    findAll()
 * @method Questiontab[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestiontabRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questiontab::class);
    }


    // /**
    //  * @return Questiontab[] Returns an array of Questiontab objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Questiontab
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
