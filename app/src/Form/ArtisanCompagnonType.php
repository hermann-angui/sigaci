<?php

namespace App\Form;

use App\Entity\Artisan;
use App\Entity\CategoryArtisan;
use App\Entity\Crm;
use App\Entity\Etablissement;
use App\Entity\MediaObject;
use App\Entity\Metiers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtisanCompagnonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe',
                'mapped' => 'true',
                'choices' => [
                    "Homme" => "Homme",
                    "Femme" => "Femme",
                ],
                'expanded' => true, // makes it render as radio
                'multiple' => false, // allows multiple selections
            ])
            ->add('prenoms', TextType::class, [
                'label' => 'Prénoms',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('dateNaissance', DateType::class, [
                'label' => 'Né le : ',
                'widget' => 'single_text',
                'html5' => false,
                'mapped' => true,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'date'],
                'required' => false,
            ])
            ->add('lieuNaissance', TextType::class, [
                'label' => 'à',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('villeNaissance', TextType::class, [
                'label' => 'Ville de naissance',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('paysNaissance', TextType::class, [
                'label' => 'Pays de naissance',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('nationalite', TextType::class, [
                'label' => 'Nom',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('domicile', TextType::class, [
                'label' => 'Domicilié à : ',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('quartier', TextType::class, [
                'label' => 'Quartier : ',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('typePieceIdentite', ChoiceType::class, [
                'label' => 'Sexe : ',
                'mapped' => 'true',
                'choices' => [
                    "CNI" => "CNI",
                    "PASSEPORT" => "PASSEPORT",
                ],
                'expanded' => true, // makes it render as radio
                'multiple' => false, // allows multiple selections
            ])
            ->add('numeroPieceIdentite', TextType::class, [
                'label' => 'N° : ',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('lieuDelivrancePieceIdentite', TextType::class,[
                'label' => 'à : ',
                'mapped' => 'true',
                'required' => 'true',
            ])
            ->add('dateDelivrancePieceIdentite', DateType::class, [
                'label' => 'Délivré le : ',
                'widget' => 'single_text',
                'html5' => false,
                'mapped' => true,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'date'],
                'required' => false,
            ])
            ->add('autoriteDelivrancePieceIdentite')
            ->add('etatCivil', ChoiceType::class, [
                'label' => 'Sexe',
                'mapped' => 'true',
                'choices' => [
                    "Marié" => "Marié",
                    "Célibataire" => "Célibataire",
                ],
                'expanded' => true, // makes it render as radio
                'multiple' => false, // allows multiple selections
            ])
            ->add('activiteExercee')
            ->add('activiteExerceeLieu')
            ->add('dateDebutActivite', DateType::class, [
                'label' => 'Début activité : ',
                'widget' => 'single_text',
                'html5' => false,
                'mapped' => true,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'date'],
                'required' => false,
            ])
            ->add('dateDebutActivitePro', DateType::class, [
                'label' => 'Début compagnonage : ',
                'widget' => 'single_text',
                'html5' => false,
                'mapped' => true,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'date'],
                'required' => false,
            ])
            ->add('telephone')
            ->add('whatsapp')
            ->add('codePostal')
            ->add('cnps')
            ->add('activitePrincipale', EntityType::class, [
                'class' => Metiers::class,
                'choice_label' => 'id',
            ])
            ->add('activiteSecondaire', EntityType::class, [
                'class' => Metiers::class,
                'choice_label' => 'id',
            ])
            ->add('numeroRM')
            ->add('numeroCarteProfessionnelle')
            ->add('nomConjoint')
            ->add('prenomsConjoint')
            ->add('nomUrgence')
            ->add('prenomsUrgence')
            ->add('formationNiveauEtude',ChoiceType::class, [
                'label' => 'Sexe',
                'mapped' => 'true',
                'choices' => [
                    "1" => "1",
                    "2" => "2",
                    "3" => "3",
                ],
                'attr' => ['class' => 'form-check form-check-inline'],
                'expanded' => true, // makes it render as radio
                'multiple' => false, // allows multiple selections
            ])
            ->add('formationClasseEtude')
            ->add('formationDiplomeObtenu')
            ->add('formationApprentissageMetier')
            ->add('formationApprentissageMetierNiveau')
            ->add('formationApprentissageMetierDiplome')
            ->add('drivingLicenseNumber')
            ->add('drivingLicensePhotoFront')
            ->add('drivingLicensePhotoBack')
            ->add('latitude')
            ->add('longitude')
            ->add('categoryArtisan', EntityType::class, [
                'class' => CategoryArtisan::class,
                'choice_label' => 'id',
            ])
            ->add('photo', EntityType::class, [
                'class' => MediaObject::class,
                'choice_label' => 'id',
            ])
            ->add('crm', EntityType::class, [
                'class' => Crm::class,
                'choice_label' => 'name',
            ])
            ->add('etablissement', EntityType::class, [
                'class' => Etablissement::class,
                'choice_label' => 'id',
            ])
            ->add('patron', EntityType::class, [
                'class' => Artisan::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artisan::class,
        ]);
    }
}
