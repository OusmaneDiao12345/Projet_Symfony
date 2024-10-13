<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank; // Importez les contraintes nécessaires
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le nom ne peut pas être vide.']),
                    new Length([
                        'min' => 2,
                        'max' => 200,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
                'attr' => ['class' => 'form-input'], // Appliquez votre style Tailwind ici
            ])
            ->add('prenom', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le prénom ne peut pas être vide.']),
                    new Length([
                        'min' => 2,
                        'max' => 25,
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
                'attr' => ['class' => 'form-input'],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => "L'email ne peut pas être vide."]),
                    new Email(['message' => "L'email '{{ value }}' n'est pas un email valide."]),
                ],
                'attr' => ['class' => 'form-input'],
            ])
            ->add('telephone', TelType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Le numéro de téléphone ne peut pas être vide.']),
                    new Regex([
                        'pattern' => "/^\+?[0-9]*$/",
                        'message' => "Le numéro de téléphone doit contenir uniquement des chiffres.",
                    ]),
                ],
                'attr' => ['class' => 'form-input'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
