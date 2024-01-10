<?php

namespace App\DataFixtures;

use App\Factory\EvenementFactory;
use App\Factory\PassageEvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class PassageEvenementFixtures extends Fixture implements OrderedFixtureInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $dateDebut = new \DateTime();
        $I5ans = new \DateInterval('P1Y');
        $dateFin = new \DateTime();
        $dateFin->add($I5ans);
        while ($dateDebut < $dateFin) {
            $heures = 10;
            $minutes = 0;
            $evenements = EvenementFactory::randomSet(5);
            for ($i = 0; $i < 5; ++$i) {
                $evenement = $evenements[$i];
                $duree = $evenement->getDuree();
                if (0 == intval($minutes)) {
                    $horaire = $heures.':'.intval($minutes).'0';
                } else {
                    $horaire = $heures.':'.intval($minutes);
                }
                PassageEvenementFactory::createOne([
                    'hDebEvenement' => $horaire,
                    'evenement' => $evenement,
                    'nbPlacesRestantes' => $evenement->getNbPlaceMaxEvent(),
                    'datePassage' => $dateDebut]);
                $minutes += $duree + 60;
                $minutes = $minutes - ($minutes % 10);
                while ($minutes >= 60) {
                    ++$heures;
                    $minutes -= 60;
                }
            }
            $dateDebut->add(new \DateInterval('P1D'));
        }
    }

    public function getOrder(): int
    {
        return 10;
    }
}
