<?php

namespace App\Form;

use App\Entity\Identification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdentificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status')
            ->add('created_at')
            ->add('updated_at')
            ->add('type')
            ->add('latitude')
            ->add('longitude')
            ->add('agent')
            ->add('artisan')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Identification::class,
        ]);
    }
}
