<?php

namespace App\Form;

use App\DTO\ClientSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('telephone', TextType::class, [
                'required' => false,
                'label' => 'Téléphone',
            ])
            ->add('surname', TextType::class, [
                'required' => false,
                'label' => 'Nom',
            ])
            ->add('compte', CheckboxType::class, [
                'required' => false,
                'label' => 'A un compte',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClientSearch::class,
        ]);
    }
}
