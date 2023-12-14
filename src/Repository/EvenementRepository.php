<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evenement>
 *
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

//    /**
//     * @return Evenement[] Returns an array of Evenement objects
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

//    public function findOneBySomeField($value): ?Evenement
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    /**
     * @throws NonUniqueResultException
     */
    public function findWithId(int $id): ?Evenement
    {
        return $this->createQueryBuilder('e')
            ->addSelect('enclos')
            ->leftJoin('e.enclos', 'enclos')
            ->where('e.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }


    public function search(string $text = ''): array
    {
        $qb = $this->createQueryBuilder('ev')

            ->where('ev.nomEvent LIKE :text')
            ->setParameter('text', '%'.$text.'%')
            ->orderBy('ev.nomEvent, ev.nbPlaceMaxEvent');
        $query = $qb->getQuery();

        return $query->execute();
    }

    public function findWithTheMostAnimals()
    {
        return $this->createQueryBuilder('e')
            ->select('e')
            ->leftJoin('e.participations', 'p')
            ->groupBy('e.id')
            ->orderBy('COUNT(p.animal)', 'DESC')
            ->getQuery()
            ->getResult();

    }

    public function findAnimals(Evenement $evenement)
    {
        $evenement = $evenement->getId();

        return $this->createQueryBuilder('e')
            ->select('a')
            ->from('App\Entity\Animal', 'a')
            ->join('a.participations', 'p1')
            ->join('e.participations', 'p2')
            ->where('p1.evenement = :evenement')
            ->andWhere('p2.evenement = :evenement')
            ->setParameter('evenement', $evenement)
            ->getQuery()
            ->getResult();

    }

}
