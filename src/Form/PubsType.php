<?php

namespace App\Form;

use App\Entity\Pubs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Serializer\SerializerInterface;

class PubsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('namePub')
            ->add('addressPub')
            ->add('phonePub')
            ->add('iframePub')
            ->add('imgPub', FileType::class, [
                'label' => 'Photo pub',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                ])
            ],
        ])
            ->add('contentPub')
            ->add('cityPub')
            ->add('cardPdf', FileType::class, [
                'label' => 'cardPdf (PDF file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
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
            'data_class' => Pubs::class,
        ]);
    }
}
