<?php

namespace App\Repository;

use App\Entity\Ticket;
use App\Entity\Visiteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ticket>
 *
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

    //    /**
    //     * @return Ticket[] Returns an array of Ticket objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ticket
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findWithId(int $id): ?Ticket
    {
        return $this->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findEventsByVisiteur(Visiteur $visiteur)
    {
        $idVisiteur = $visiteur->getId();

        return $this->createQueryBuilder('t')
            ->select('t')
            ->join('t.visiteur', 'v')
            ->where('v.id = :idVisiteur')
            ->setParameter('idVisiteur', $idVisiteur)
            ->orderBy('t.dateTicket')
            ->getQuery()
            ->getResult();
    }

    public function findAnimals(Ticket $ticket)
    {
        $idTicket = $ticket->getId();

        return $this->createQueryBuilder('t')
            ->join('t.vues', 'v')
            ->join('v.animal', 'an')
            ->where('t.id = :idTicket')
            ->setParameter('idTicket', $idTicket)
            ->getQuery()
            ->getResult();
    }

    public function findUsedByVisiteur(Visiteur $visiteur)
    {
        $idVisiteur = $visiteur->getId();

        return $this->createQueryBuilder('t')
                    ->select('t')
                    ->join('t.visiteur', 'v')
                    ->where('v.id = :idVisiteur')
                    ->andWhere('t.dateTicket < CURRENT_DATE()')
                    ->setParameter('idVisiteur', $idVisiteur)
                    ->orderBy('t.dateTicket')
                    ->getQuery()
                    ->getResult();
    }

    public function findNotUsedByVisiteur(Visiteur $visiteur)
    {
        $idVisiteur = $visiteur->getId();

        return $this->createQueryBuilder('t')
            ->select('t')
            ->join('t.visiteur', 'v')
            ->where('v.id = :idVisiteur')
            ->andWhere('t.dateTicket >= CURRENT_DATE()')
            ->setParameter('idVisiteur', $idVisiteur)
            ->orderBy('t.dateTicket')
            ->getQuery()
            ->getResult();
    }
}
