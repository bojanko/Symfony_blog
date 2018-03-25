<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('ime', 'Symfony\Component\Form\Extension\Core\Type\TextType',
			array("label" => "Enter your Name"))
            ->add('email', 'Symfony\Component\Form\Extension\Core\Type\TextType',
			array("label" => "Enter your E-mail (Optional)", "required" => false))
            ->add('komentar', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',
			array("label" => "Enter your comment"))
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType',
			array("label" => "Comment"))
        ;
    }
}

?>