<?php

namespace App\Form;

use App\Entity\Pubs;
use App\Entity\Menus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MenusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameMenu')
            ->add('priceMenu')
            ->add('pub', EntityType::class, [
                'class' => Pubs::class,
                'choice_label' => 'namePub',
            ])
            ->add('imgMenu', FileType::class, [
                'label' => 'image du menu',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez entrer un format de document'
                        ])
                    ],
                ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menus::class,
        ]);
    }
}
