<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    private const ROLE_ADMIN = 'ROLE_ADMIN';
    private const ROLE_AUTHOR = 'ROLE_AUTHOR';
    private const ROLE_USER = 'ROLE_USER';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('userNickName')
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'choices'  => $rolesChoices = $this->getRolesArray()])
            ->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    
    public function getRolesArray() : array
    {
        $choices = ["User" => UserType::ROLE_USER,
                    "Author" => UserType::ROLE_AUTHOR,
                    "Administrator" => UserType::ROLE_ADMIN
                ];
        return $choices;
    }
}
