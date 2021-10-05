<?php

namespace App\Form;

use App\Entity\Pubs;
use App\Entity\Menus;
use App\Entity\Category;
use App\Entity\Products;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameProduct')
            ->add('priceProduct')
            ->add('contentProduct')
            ->add('pub', EntityType::class, [
                'class' => Pubs::class,
                'choice_label' => 'namePub',
            ])
            ->add('menus', EntityType::class, [
                'class' => Menus::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'nameMenu',
            ])
            ->add('categories', EntityType::class, [ 'class' => Categories::class, 'choice_label' => 'nameCategory',
            ])
            ->add('imgProduct', FileType::class, [
                'label' => 'Photo Event',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                    'image/*',
                    ],
                    'mimeTypesMessage' => 'Veuillez entrer un format de document
                    valide',
                ])
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
