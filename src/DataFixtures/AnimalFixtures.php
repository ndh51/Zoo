<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Enclos;
use App\Entity\Famille;
use App\Factory\AnimalFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AnimalFixtures extends Fixture implements OrderedFixtureInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $tab = json_decode(file_get_contents(__DIR__.'/data/Animaux.json'), true);
        $animaux = $tab['animaux'];

        $famRep = $this->entityManager->getRepository(Famille::class);
        $catRep = $this->entityManager->getRepository(Categorie::class);
        $encRep = $this->entityManager->getRepository(Enclos::class);

        foreach ($animaux as $animal) {
            AnimalFactory::createOne(['nomAnimal' => $animal['nom'],
                'descAnimal' => $animal['description'],
                'idFamille' => $famRep->findOneBy(['nomFamille' => $animal['famille']]),
                'idCategorie' => $catRep->findOneBy(['nomCategorie' => $animal['categorie']]),
                'idEnclos' => $encRep->findOneBy(['nomEnclos' => $animal['enclos']]),
            ]);
        }
    }

    public function getOrder()
    {
        return 4;
    }
}
