<?php

namespace App\Form;

use App\Entity\Immatriculation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImmatriculationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status')
            ->add('created_at')
            ->add('updated_at')
            ->add('type')
            ->add('identification_id')
            ->add('payment_type')
            ->add('latitude')
            ->add('longitude')
            ->add('agent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Immatriculation::class,
        ]);
    }
}
