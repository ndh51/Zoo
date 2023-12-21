<?php

namespace App\Repository;

use App\Entity\PassageEvenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PassageEvenement>
 *
 * @method PassageEvenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassageEvenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassageEvenement[]    findAll()
 * @method PassageEvenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassageEvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PassageEvenement::class);
    }

//    /**
//     * @return PassageEvenement[] Returns an array of PassageEvenement objects
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

//    public function findOneBySomeField($value): ?PassageEvenement
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
