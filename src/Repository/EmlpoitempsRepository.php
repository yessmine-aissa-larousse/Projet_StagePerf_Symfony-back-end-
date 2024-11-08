<?php

namespace App\Repository;

use App\Entity\Emlpoitemps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Emlpoitemps>
 *
 * @method Emlpoitemps|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emlpoitemps|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emlpoitemps[]    findAll()
 * @method Emlpoitemps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmlpoitempsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emlpoitemps::class);
    }

//    /**
//     * @return Emlpoitemps[] Returns an array of Emlpoitemps objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Emlpoitemps
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
