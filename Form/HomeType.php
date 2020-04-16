<?php

namespace App\Form;

use App\Entity\Home;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class HomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tittle')
            ->add('text', CKEditorType::class, ['label'=>'Texte  d\'accueil'])
            ->add('imageFile', FileType::class,['required'=>false,'label'=>'Intégrer une image'] )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Home::class,
        ]);
    }
}
