<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Animal>
 *
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

//    /**
//     * @return Animal[] Returns an array of Animal objects
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

//    public function findOneBySomeField($value): ?Animal
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function search(string $text = ''): array
    {
        $qb = $this->createQueryBuilder('an')

            ->where('an.nomAnimal LIKE :text')
            ->setParameter('text', '%'.$text.'%')
            ->orderBy('an.nomAnimal');
        $query = $qb->getQuery();

        return $query->execute();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findWithId(int $id): ?Animal
    {
        return $this->createQueryBuilder('a')
            ->addSelect('famille')
            ->leftJoin('a.idFamille', 'famille')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findWithTheMostEvent()
    {
        $this->createQueryBuilder('a')
            ->select('a.id', 'a.nomAnimal', 'COUNT(p.idEvent) as eventCount')
            ->from('App\Entity\Animal', 'a')
            ->join('a.participations', 'p')
            ->groupBy('a.id')
            ->orderBy('eventCount', 'DESC')
            ->setMaxResults(10);
    }
}
