<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Atelier;
use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('atelier', EntityType::class, [
            'class'=> Atelier::class,
            'choice_label'=>'tittle'
      ])
            ->add('title', null, ['label'=>'Nom du cour ou du stage'])
            ->add('description', null, ['label'=>'Description, présentation du cour'])
            ->add('duree', null, ['label'=>'Durée'])
            ->add('public', null, ['label'=>'Type de public'])
            ->add('tarifs', null, ['label'=>'Présentation des tarifs'])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
