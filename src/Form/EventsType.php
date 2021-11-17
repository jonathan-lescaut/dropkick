<?php

namespace App\Form;

use App\Entity\Pubs;
use App\Entity\Events;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class EventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameEvent')
            ->add('fbEvent')
            ->add('imgEvent', FileType::class, [
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
            ->add('dateEvent', BirthdayType::class, [
                'placeholder' => [
                'day' => 'Jour','Mois', 'day' => 'Jour','year' => 'Année',
                ]])
            ->add('contentEvent', CKEditorType::class)
            ->add('placeEvent')
            ->add('pubs', EntityType::class, [ 'class' => Pubs::class, 'choice_label' => 'namePub',
])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}
