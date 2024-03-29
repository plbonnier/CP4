<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichFileType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
            'label' => 'Nom de famille',
            ])
            ->add('firstname', TextType::class, [
            'label' => 'Prénom',
            'required' => false,
            ])
            ->add('adress', TextType::class, [
            'label' => 'Adresse',
            'required' => false,
            ])
            ->add('zipcode', TextType::class, [
            'label' => 'Code Postal',
            'required' => false,
            ])
            ->add('city', TextType::class, [
            'label' => 'Ville',
            'required' => false,
            ])
            ->add('country', TextType::class, [
            'label' => 'Pays',
            'required' => false,
            ])
            ->add('pictureFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true,
                'download_uri' => false,
            ])
            ->add('email')
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('rgpd', CheckboxType::class, [
                // 'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
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
