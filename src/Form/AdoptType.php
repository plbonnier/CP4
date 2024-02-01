<?php

namespace App\Form;

use App\Entity\Adopt;
use App\Entity\OrangOutan;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdoptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('money', NumberType::class, [
                'label' => 'Votre don',
            ])
            ->add('orangoutan', EntityType::class, [
                'class' => OrangOutan::class,
                'choice_label' => 'name',
                'label' => 'Qui parrainez-vous ?'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adopt::class,
        ]);
    }
}
