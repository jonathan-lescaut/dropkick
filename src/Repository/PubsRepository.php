<?php

namespace App\Repository;

use App\Entity\Pubs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pubs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pubs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pubs[]    findAll()
 * @method Pubs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PubsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pubs::class);
    }

    // /**
    //  * @return Pubs[] Returns an array of Pubs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pubs
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
