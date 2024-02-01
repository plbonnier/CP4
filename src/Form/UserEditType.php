<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => false,
                ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom de famille',
                ])
            ->add('zipcode', TextType::class, [
                    'label' => 'Code Postal',
                    'required' => false,
                    ])
            ->add('adress', TextType::class, [
                    'label' => 'Adresse',
                    'required' => false,
                    ])
            ->add('country', TextType::class, [
                    'label' => 'Pays',
                    'required' => false,
                    ])
            ->add('city', TextType::class, [
            'label' => 'Ville',
            'required' => false,
            ])
            ->add('pictureFile', VichFileType::class, [
                'required'      => false,
                'allow_delete'  => true,
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
