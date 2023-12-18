<?php

namespace App\Repository;

use App\Entity\Ticket;
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

    public function findEventsByVisiteur(int $idVisiteur)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT e.nom_event, e.image_id, t.id, t.date_ticket
        FROM visiteur v JOIN ticket t ON (t.visiteur_id = v.id) JOIN reservation_evenement r ON (t.id = r.ticket_id) JOIN passage_evenement p ON (r.passage_evenement_id = p.id) JOIN evenement e ON (e.id = p.evenement_id)
        WHERE v.id = :idVisiteur
        ORDER BY t.id';

        $params = ['idVisiteur' => $idVisiteur];


        return $conn->executeQuery($sql, $params)->fetchAllAssociative();

    }
}
