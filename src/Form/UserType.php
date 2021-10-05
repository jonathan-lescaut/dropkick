<?php

namespace App\Form;

use App\Entity\Pubs;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'role' => ['ROLE_ADMIN']
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // var_dump($options['role']);
        $builder
            ->add('email')
//             ->add('roles', ChoiceType::class, [
//                 'choices' => [
//                     'Utilisateur' => User::ROLE_USER,
//                     'Employé' => User::ROLE_WORKER,
//                     'Cadre' => User::ROLE_MASTER,
//                     'Administrateur' => User::ROLE_ADMIN,
//                 ],
//                 'multiple' => true,
//                 'expanded' => true,
//                 'required' => true,
// ])
            ->add('lastNameUser')
            ->add('firstNameUser')
            ->add('addressUser')
            ->add('cityUser')
            ->add('cpUser')
            ->add('pubs', EntityType::class, [
                'class' => Pubs::class,
                'choice_label' => 'namePub',
            ]);
            
            if ($options['role'][0] === 'ROLE_ADMIN') {
                
                $builder
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
                ]);
            }

        ;
    }


}
