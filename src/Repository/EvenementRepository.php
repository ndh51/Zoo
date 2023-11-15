<?php

namespace App\Repository;

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
    public function findWithCategory(int $id): ?Evenement
    {
        return $this->createQueryBuilder('e')
            ->where('e.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findEvenementsMostPlace(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM evenement e
        ORDER BY e.nb_pLace_max_event ASC, e.nom_event
        ';

        return $conn->executeQuery($sql)->fetchAllAssociative();
    }

    /**
     * @throws Exception
     * @throws Exception
     */
    public function findAllEvenement(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM evenement e
        ORDER BY e.nom_event, e.nb_pLace_max_event ASC
        ';

        return $conn->executeQuery($sql)->fetchAllAssociative();

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


}
