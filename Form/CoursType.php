<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Atelier;
use App\Entity\Cours;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('description', CKEditorType::class, ['label'=>'Description, présentation du cour'])
            ->add('duree', null, ['label'=>'Durée'])
            ->add('public', null, ['label'=>'Type de public'])
            ->add('tarifs', CKEditorType::class, ['label'=>'Présentation des tarifs'])
            ->add('imageFile', FileType::class,['required'=>false,'label'=>'Intégrer une image'] )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
