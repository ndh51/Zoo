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
        return $this->createQueryBuilder('a')
            ->select('a')
            ->leftJoin('a.participations', 'p')
            ->groupBy('a.id')
            ->orderBy('COUNT(p.evenement)', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findWithTheSameFamily(Animal $animal)
    {
        $idFamille = $animal->getIdFamille();
        $animal = $animal->getId();

        return $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.id != :animal')
            ->andWhere('a.idFamille = :idFamille')
            ->setParameter('idFamille', $idFamille)
            ->setParameter('animal', $animal)
            ->orderBy('a.nomAnimal')
            ->getQuery()
            ->getResult();
    }

    public function findEvents(Animal $animal)
    {
        $animal = $animal->getId();

        return $this->createQueryBuilder('a')
            ->select('e')
            ->from('App\Entity\Evenement', 'e')
            ->join('a.participations', 'p1')
            ->join('e.participations', 'p2')
            ->where('p1.animal = :animal')
            ->andWhere('p2.animal = :animal')
            ->setParameter('animal', $animal)
            ->getQuery()
            ->getResult();

    }
}
