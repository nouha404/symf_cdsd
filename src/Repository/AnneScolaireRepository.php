<?php

namespace App\Repository;

use App\Entity\AnneScolaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnneScolaire>
 *
 * @method AnneScolaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnneScolaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnneScolaire[]    findAll()
 * @method AnneScolaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnneScolaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnneScolaire::class);
    }

//    /**
//     * @return AnneScolaire[] Returns an array of AnneScolaire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AnneScolaire
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
