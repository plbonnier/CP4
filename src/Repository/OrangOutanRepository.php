<?php

namespace App\Repository;

use App\Entity\OrangOutan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrangOutan>
 *
 * @method OrangOutan|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrangOutan|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrangOutan[]    findAll()
 * @method OrangOutan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrangOutanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrangOutan::class);
    }

    //    /**
    //     * @return OrangOutan[] Returns an array of OrangOutan objects
    //     */
    // public function paginationQuery()
    // {
    //     return $this->createQueryBuilder('o')
    //         ->orderBy('o.id', 'ASC')
    //         ->getQuery();

    // }

    //    public function findOneBySomeField($value): ?OrangOutan
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
