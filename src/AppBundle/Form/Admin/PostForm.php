<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PostForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('naslov', 'Symfony\Component\Form\Extension\Core\Type\TextType',
			array("label" => "Enter post title"))
            ->add('sadrzaj', 'Symfony\Component\Form\Extension\Core\Type\TextareaType',
			array("label" => "Enter post text"))
			->add("category", 'Symfony\Bridge\Doctrine\Form\Type\EntityType',
			array("expanded" => true, "multiple" => true,
			"class" => 'AppBundle\Entity\Category',
			'choice_label' => function($cat){return $cat->getName();}))
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType',
			array("label" => "Add post"))
        ;
    }
}

?>