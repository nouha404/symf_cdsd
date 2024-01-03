<?php

namespace App\Repository;

use App\Entity\CoursTrue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoursTrue>
 *
 * @method CoursTrue|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoursTrue|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoursTrue[]    findAll()
 * @method CoursTrue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursTrueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoursTrue::class);
    }

//    /**
//     * @return CoursTrue[] Returns an array of CoursTrue objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CoursTrue
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
