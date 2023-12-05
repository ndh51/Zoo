<?php

namespace App\DataFixtures;

use App\Entity\Enclos;
use App\Factory\EvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class EvenementFixtures extends Fixture implements OrderedFixtureInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $tabEv = json_decode(file_get_contents(__DIR__.'/data/Evenement.json'), true);
        $encRep = $this->entityManager->getRepository(Enclos::class);

        $evenements = $tabEv['evenements'];
        foreach ($evenements as $evenement) {
            EvenementFactory::createOne(['nomEvent' => $evenement['nom'],
                'descEvent' => $evenement['description'],
                'nbPlaceMaxEvent' => random_int(15, 100),
                'idEnclos' => $encRep->findOneBy(['nomEnclos' => $evenement['enclos']]),
            ]);
        }
    }

    public function getOrder(): int
    {
        return 5;
    }
}
