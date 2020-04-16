<?php

namespace App\Form;

use App\Entity\Footer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class FooterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tittle',CKEditorType::class, ['label'=>'Titre  du footer'])
            ->add('text', CKEditorType::class, ['label'=>'Texte  du footer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Footer::class,
        ]);
    }
}
