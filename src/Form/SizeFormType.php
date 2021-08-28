<?php

namespace App\Form;

use App\Entity\Size;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SizeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sizeName',TextType::class, 
            [ 
                'label' => "Size of laptop",
                'required' => true
            ])
            ->add('sizeDescription',TextType::class, 
            [ 
                'label' => "Size Description",
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Size::class,
        ]);
    }
}
