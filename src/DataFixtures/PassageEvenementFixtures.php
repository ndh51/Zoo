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
        $faker = PassageEvenementFactory::faker();
        $dateDebut = new \DateTime();
        $I5ans = new \DateInterval('P5Y');
        $dateFin = $dateDebut->add($I5ans);
        while ($dateDebut < $dateFin) {
            $heures = 10;
            $minutes = 0;
            $evenements = EvenementFactory::randomSet(5);
            for ($i = 0; $i < 5; ++$i) {
                $evenement = $evenements[$i];
                PassageEvenementFactory::createOne([
                    'hDebEvenement' => $heures.':'.$minutes,
                    'evenement' => $evenement,
                    'nbPlacesRestantes' => $evenement->getNbPlaceMaxEvent(),
                    'datePassage' => $dateDebut]);
                $manager->persist();
                $dateDebut->add(new \DateInterval('P1D'));
            }
        }
    }

    public function getOrder(): int
    {
        return 10;
    }
}
