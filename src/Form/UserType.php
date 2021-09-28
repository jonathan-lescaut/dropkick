<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => User::ROLE_USER,
                    'Employé' => User::ROLE_WORKER,
                    'Cadre' => User::ROLE_MASTER,
                    'Administrateur' => User::ROLE_ADMIN,
                ],
                'multiple' => true,
                'expanded' => true,
                'required' => true,
])
            ->add('lastNameUser')
            ->add('firstNameUser')
            ->add('addressUser')
            ->add('cityUser')
            ->add('cpUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
