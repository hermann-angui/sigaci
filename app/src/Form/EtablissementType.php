<?php

namespace App\Form;

use App\Entity\Etablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtablissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('primaryactivity')
            ->add('activitystartdate')
            ->add('secondaryactivity')
            ->add('companyname')
            ->add('companyacronym')
            ->add('companypurpose')
            ->add('companylegalstatus')
            ->add('numregistremetier')
            ->add('numrea')
            ->add('numrccm')
            ->add('companycapitalsocial')
            ->add('companyregimefiscal')
            ->add('companynumcnps')
            ->add('companynombreassocies')
            ->add('companyduree')
            ->add('companytaxpayernumber')
            ->add('companyadressepostale')
            ->add('companytel')
            ->add('companyfax')
            ->add('companydepartement')
            ->add('companycommune')
            ->add('companysp')
            ->add('companyquartier')
            ->add('companyvillage')
            ->add('companylotnumber')
            ->add('companyilotnumber')
            ->add('companyeffectsalariehomme')
            ->add('companyeffectsalariefemme')
            ->add('companyeffectapprentishomme')
            ->add('companyeffectepprentishomme')
            ->add('companyeffectapprentisfemme')
            ->add('activitylocation')
            ->add('activityLocation')
            ->add('activitycountry')
            ->add('activitycity')
            ->add('activityquartier')
            ->add('latitude')
            ->add('longitude')
            ->add('crm')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}
