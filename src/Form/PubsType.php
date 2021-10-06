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

class PubsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('namePub')
            ->add('imgPub', FileType::class, [
                'label' => 'Photo pub',
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
            ->add('contentPub')
            ->add('cityPub')
            ->add('menu', EntityType::class, [
                'class' => Menus::class,
                'choice_label' => 'nameMenu',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pubs::class,
        ]);
    }
}
