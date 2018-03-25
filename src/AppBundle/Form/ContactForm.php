<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('ime', 'Symfony\Component\Form\Extension\Core\Type\TextType',
			array("label" => "Enter your Name (Optional)", "required" => false))
            ->add('email', 'Symfony\Component\Form\Extension\Core\Type\TextType',
			array("label" => "Enter your E-mail"))
            ->add('poruka', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',
			array("label" => "Enter your message"))
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType',
			array("label" => "Send"))
        ;
    }
}

?>