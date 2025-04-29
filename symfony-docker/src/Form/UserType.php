<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            /*->add('roles', ChoiceType::class, array(
                    'attr'  =>  array('class' => 'form-control',
                        'style' => 'margin:5px 0;'),
                    'choices' =>
                        array
                        (
                            'ROLE_ADMIN' => array
                            (
                                'Yes' => 'ROLE_ADMIN',
                            ),

                        )
                ,
                    'multiple' => true,

                )
            )
            */
            ->add("name")
            ->add('password', null, [
                'required' => false,  // Make password optional
                'empty_data' => '',    // Set empty value if field is empty
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
