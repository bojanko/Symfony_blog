<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class LoginForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('_username', 'Symfony\Component\Form\Extension\Core\Type\TextType',
			array("label" => "Enter your username"))
            ->add('_password', 'Symfony\Component\Form\Extension\Core\Type\PasswordType',
			array("label" => "Enter your password"))
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType',
			array("label" => "Login"))
        ;
    }
}

?>