<?php

namespace App\Form;

use App\Entity\Visiteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'empty_data' => '',
                'label' => 'Email',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/',
                        'message' => 'L\'adresse email doit être sous la forme "quelquechose@quelquechose.quelquechose".',
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter conditions d’utilisations',
                                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter conditions d’utilisation',
                    ]),
                ],
            ])
            ->add('nomVisiteur', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Z][a-zA-Z]*$/',
                        'message' => 'Le nom doit commencer par une majuscule.',
                    ]),
                ],
            ])
            ->add('prenomVisiteur', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Z][a-zA-Z]*$/',
                        'message' => 'Le prénom doit commencer par une majuscule.',
                    ]),
                ],
            ])
            ->add('villeVisiteur', TextType::class, [
                'label' => 'Ville',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Z][a-zA-Z]*$/',
                        'message' => 'La ville doit commencer par une majuscule.',
                    ]),
                ],
            ])
            ->add('adVisiteur', TextType::class, [
                'label' => 'Adresse',
            ])
            ->add('cpVisiteur', TextType::class, [
                'label' => 'Code postal',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{5}$/',
                        'message' => 'Le code postal doit contenir exactement cinq chiffres.',
                    ]),
                ],
            ])
            ->add('telVisiteur', TextType::class, [
                'label' => 'Téléphone',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{10}$/',
                        'message' => 'Le numéro de téléphone doit contenir exactement dix chiffres.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Visiteur::class,
        ]);
    }
}
