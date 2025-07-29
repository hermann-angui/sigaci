<?php

namespace App\Form;

use App\Entity\Artisan;
use App\Entity\CategoryArtisan;
use App\Entity\Crm;
use App\Entity\Entreprise;
use App\Entity\Identification;
use App\Entity\Immatriculation;
use App\Entity\MediaObject;
use App\Entity\Metiers;
use App\Entity\Pays;
use App\Entity\Villes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtisanEntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('sexe')
            ->add('prenoms')
            ->add('dateNaissance')
            ->add('lieuNaissance')
            ->add('domicile')
            ->add('quartier')
            ->add('typePieceIdentite')
            ->add('numeroPieceIdentite')
            ->add('lieuDelivrancePieceIdentite')
            ->add('dateDelivrancePieceIdentite')
            ->add('autoriteDelivrancePieceIdentite')
            ->add('etatCivil')
            ->add('activiteExerceeLieu')
            ->add('dateDebutActivite')
            ->add('dateDebutActivitePro')
            ->add('telephone')
            ->add('whatsapp')
            ->add('codePostal')
            ->add('cnps')
            ->add('numeroRM')
            ->add('numeroCarteProfessionnelle')
            ->add('nomConjoint')
            ->add('prenomsConjoint')
            ->add('nomUrgence')
            ->add('prenomsUrgence')
            ->add('telephoneUrgence')
            ->add('formationNiveauEtude')
            ->add('formationClasseEtude')
            ->add('formationDiplomeObtenu')
            ->add('formationApprentissageMetier')
            ->add('formationApprentissageMetierNiveau')
            ->add('formationApprentissageMetierDiplome')
            ->add('numeroPermisConduire')
            ->add('latitude')
            ->add('longitude')
            ->add('created_at')
            ->add('modified_at')
            ->add('photo', EntityType::class, [
                'class' => MediaObject::class,
                'choice_label' => 'id',
            ])
            ->add('photoPieceIdentiteRecto', EntityType::class, [
                'class' => MediaObject::class,
                'choice_label' => 'id',
            ])
            ->add('photoPieceIdentiteVerso', EntityType::class, [
                'class' => MediaObject::class,
                'choice_label' => 'id',
            ])
            ->add('photoPermisVerso', EntityType::class, [
                'class' => MediaObject::class,
                'choice_label' => 'id',
            ])
            ->add('photoPermisRecto', EntityType::class, [
                'class' => MediaObject::class,
                'choice_label' => 'id',
            ])
            ->add('crm', EntityType::class, [
                'class' => Crm::class,
                'choice_label' => 'id',
            ])
            ->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'id',
            ])
            ->add('patron', EntityType::class, [
                'class' => Artisan::class,
                'choice_label' => 'id',
            ])
            ->add('categoryArtisan', EntityType::class, [
                'class' => CategoryArtisan::class,
                'choice_label' => 'id',
            ])
            ->add('villeNaissance', EntityType::class, [
                'class' => Villes::class,
                'choice_label' => 'id',
            ])
            ->add('paysNaissance', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'id',
            ])
            ->add('nationalite', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'id',
            ])
            ->add('immatriculation', EntityType::class, [
                'class' => Immatriculation::class,
                'choice_label' => 'id',
            ])
            ->add('identification', EntityType::class, [
                'class' => Identification::class,
                'choice_label' => 'id',
            ])
            ->add('activiteSecondaire', EntityType::class, [
                'class' => Metiers::class,
                'choice_label' => 'id',
            ])
            ->add('activiteExercee', EntityType::class, [
                'class' => Metiers::class,
                'choice_label' => 'id',
            ])
            ->add('activitePrincipale', EntityType::class, [
                'class' => Metiers::class,
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
