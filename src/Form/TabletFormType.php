<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Tablet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TabletFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, 
            [ 
                'label' => "Name",
                'required' => true
            ])
            ->add('price',MoneyType::class,
            [
                'label' => "Price",
                'currency' => "USD"
            ])
            ->add('image',FileType::class,
            [
                'data_class' => null,
                'required' => is_null($builder->getData()->getImage())
            ])
            ->add('brand',EntityType::class,
            [
                'class' => Brand::class,
                'choice_label' => 'brandName',
                'multiple' => false,  //true: select many, false: select only 1
                'expanded' => false  //true: checkbox   , false: drop-down list
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tablet::class,
        ]);
    }
}
