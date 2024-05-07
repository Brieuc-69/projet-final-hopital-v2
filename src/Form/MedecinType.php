<?php

namespace App\Form;

use App\Entity\Experience;
use App\Entity\File;
use App\Entity\Medecin;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedecinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('experience')
            ->add('disponible', null, [
                'widget' => 'single_text',
            ])
            ->add('tarif')
            ->add('tel')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('noteEtoile', EntityType::class, [
                'class' => Experience::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('url', EntityType::class, [
                'class' => File::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}
