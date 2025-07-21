<?php

namespace App\Form;

use App\Entity\Crm;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => "nom d'utilisateur",
                'mapped' => true,
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'mapped' => true,
                'required' => true
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => true,
                'invalid_message' => "", // $this->translator->trans('invalid_password'),
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => "", // $this->translator->trans('password_is_blank'),
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => "", // $this->translator->trans('invalid_password_length'),
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('passwordConfirmPass', PasswordType::class, [
                'label' => 'Confirmer le mot de passe',
                'mapped' => false,
                'invalid_message' => "", // $this->translator->trans('invalid_password'),
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => "", // $this->translator->trans('password_is_blank'),
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => "", // $this->translator->trans('invalid_password_length'),
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Prénoms',
                'mapped' => true,
                'required' => true
            ])
            ->add('prenoms', TextType::class, [
                'label' => 'Prénoms',
                'mapped' => true,
                'required' => true
            ])
            ->add('lieu_naissance')
            ->add('date_de_naissance')
            ->add('nationalite')
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe',
                'required' => false,
                'mapped' => true,
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ],
                'empty_data' => 'Homme',
                'data' => 'Homme',
            ])
            ->add('cni', TextType::class, [
                'label' => 'N° CNPS',
                'mapped' => true,
                'required' => false
            ])
            ->add('telephone', TelType::class, [
                'label' => "Whatsapp",
                //'attr' => ['class' => 'input-mask', 'data-inputmask' => "'mask': '9999999999'"],
                'mapped' => true,
                'required' => false,
            ])
            ->add('adresse', TextType::class, [
                'label' => "Adresse",
                'mapped' => true,
                'required' => true
            ])
            ->add('ville', TextType::class, [
                'label' => "Ville",
                'mapped' => true,
                'required' => true
            ])
            ->add('commune', TextType::class, [
                'label' => "Commune",
                'mapped' => true,
                'required' => true
            ])
            ->add('quartier', TextType::class, [
                'label' => "Quartier",
                'mapped' => true,
                'required' => true
            ])
            ->add('type')
            ->add('is_active', CheckboxType::class, [
                'label' => 'Activé',
                'mapped' => true,
                'required' => false
            ])
            ->add('crm', EntityType::class, [
                'class' => Crm::class,
                'choice_label' => 'name',
                'label' => 'CRM',
                'mapped' => true,
                'placeholder' => 'Assigner à une CRM'
            ])
            ->add('photoFile', FileType::class, [
                'label' => 'Photo',
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
