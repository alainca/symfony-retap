<?php

namespace App\Form;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Galerie;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
       
            ->add('title', null, ['label'=>'Nom du cour ou du stage'])
            ->add('description', CKEditorType::class, ['label'=>'Description de la galerie'])
            
            ->add('imageFile', FileType::class,['required'=>false,'label'=>'Intégrer une image'] )
            ->add('imageFile2', FileType::class,['required'=>false,'label'=>'Intégrer une seconde image'] )
            ->add('imageFile3', FileType::class,['required'=>false,'label'=>'Intégrer une troisième image'] )
            ->add('imageFile4', FileType::class,['required'=>false,'label'=>'Intégrer une quatrième image'] )
            ->add('imageFile5', FileType::class,['required'=>false,'label'=>'Intégrer une cinquième image'] )
            ->add('imageFile6', FileType::class,['required'=>false,'label'=>'Intégrer une sixième image'] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Galerie::class,
        ]);
    }
}
