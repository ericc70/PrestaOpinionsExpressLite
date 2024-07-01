<?php
declare(strict_types=1);
namespace Ericc70\Expressopinionlite\Form\Type;

// src/Form/QuestionType.php

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('content', TextType::class, ['attr' => ['class' => 'auto-save'  ]])
        ;
    }

}

