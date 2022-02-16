<?php

namespace App\Form;

use App\Entity\Pubs;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PubsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('namePub')
            ->add('addressPub', TelType::class)
            ->add('cpPub')
            ->add('phonePub')
            ->add('iframePub')
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
            ->add('schedulePub', CKEditorType::class)

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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pubs::class,
        ]);
    }
}
