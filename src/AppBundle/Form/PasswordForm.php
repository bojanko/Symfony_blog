<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class PasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', 'Symfony\Component\Form\Extension\Core\Type\RepeatedType', array(
				'invalid_message' => 'The password fields must match.',
                'type' => 'Symfony\Component\Form\Extension\Core\Type\PasswordType',
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType',
			array("label" => "Change password"))
        ;
    }
}

?>