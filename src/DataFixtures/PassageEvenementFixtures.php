<?php

namespace App\DataFixtures;

use App\Entity\Evenement;
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
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();
        $tab = json_decode(file_get_contents(__DIR__.'/data/PassageEvenement.json'), true);
        $passages = $tab['passageEvenement'];

        $evenement = $this->entityManager->getRepository(Evenement::class);
        foreach ($passages as $passage) {
            PassageEvenementFactory::createOne([
                'hDebEvenement' => $passage['hDebEvenement'],
                'Evenement' => $evenement->findOneBy(['nomEvent' => $passage['Evenement']]),
            ]);
        }
    }

    public function getOrder(): int
    {
        return 10;
    }
}
