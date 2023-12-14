<?php

namespace App\Form;

use App\Entity\Enclos;
use App\Entity\Evenement;
use App\Entity\Image;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        // j'initie l'attribut au repository de l'image
        $this->imageRepository = $imageRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEvent', TextType::class, ['empty_data' => '', 'label' => 'Nom de l\'évènement '])
            ->add('descEvent', TextType::class, ['empty_data' => '', 'label' => 'Description de l\'évènement '])
            ->add('nbPlaceMaxEvent', IntegerType::class, ['label' => 'Nombre de places maximum '])
            ->add('idEnclos', EntityType::class, [
                'required' => false,
                'class' => Enclos::class,
                'choice_label' => 'nomEnclos',
                'label' => 'Enclos ',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('c')
                        ->orderBy('c.nomEnclos', 'ASC');
                },
            ]
            )
            ->add('image', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'id',
                'label' => 'L\'image attribuée à cet animal sera l\'image par défaut ',
                'data' => $this->getDefaultImage(),
                'attr' => ['style' => 'display:none;'],
            ])
        ;
    }

    private function getDefaultImage()
    {
        // je récupère l'image par défaut dans le repository de toutes les images
        return $this->imageRepository->find(1);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
