<?php

namespace App\Repository;

use App\Entity\Professeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Professeur>
 *
 * @method Professeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Professeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Professeur[]    findAll()
 * @method Professeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfesseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Professeur::class);
    }

//    /**
//     * @return Professeur[] Returns an array of Professeur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
// ProfesseurRepository.php

    public function findByFilters($grades)
    {
        $qb = $this->createQueryBuilder('p')
                ->leftJoin('p.grades', 'g')
                ->leftJoin('p.classe', 'c');

        if (!empty($grades)) {
            $qb->andWhere(':grade MEMBER OF p.grades')
                ->setParameter('grade', $grades);
        } 
       
        /*
        if (!empty($classes)) {
            $qb->andWhere(':classe MEMBER OF p.classe')
                ->setParameter('classe', $classes);
        }
        */
        
        return $qb->getQuery()->getResult();
    }

    
    
    

}
