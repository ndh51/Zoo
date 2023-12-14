<?php

namespace App\DataFixtures;

use App\Entity\Enclos;
use App\Entity\Image;
use App\Factory\EvenementFactory;
use App\Factory\ImageFactory;
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
        $imgRep = $this->entityManager->getRepository(Image::class);

        $evenements = $tabEv['evenements'];
        foreach ($evenements as $evenement) {
            if (null === $image = $imgRep->findOneBy(['pathImage' => '/img/evenements/'.$evenement['nom'].'.jpg'])) {
                $image = ImageFactory::createOne();
            }
            EvenementFactory::createOne(['nomEvent' => $evenement['nom'],
                'descEvent' => $evenement['description'],
                'nbPlaceMaxEvent' => random_int(15, 100),
                'idEnclos' => $encRep->findOneBy(['nomEnclos' => $evenement['enclos']]),
                'image' => $image,
            ]);
        }
    }

    public function getOrder(): int
    {
        return 6;
    }
}
