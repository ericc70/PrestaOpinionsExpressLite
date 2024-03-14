<?php

namespace Ericc70\Expressopinionlite\Form\Type;



// src/Form/CalendarFormType.php



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('submitDateDay', ButtonType::class, ['label' => 'Jour'])
            ->add('submitDateMonth', ButtonType::class, ['label' => 'Mois'])
            ->add('submitDateYear', ButtonType::class, ['label' => 'Année'])
            ->add('submitDateDayPrev', ButtonType::class, ['label' => 'Jour-1'])
            ->add('submitDateMonthPrev', ButtonType::class, ['label' => 'Mois-1'])
            ->add('submitDateYearPrev', ButtonType::class, ['label' => 'Année-1'])
            ->add('datepickerFrom', TextType::class, ['label' => 'Du'])
            ->add('datepickerTo', TextType::class, ['label' => 'au'])
            ->add('submitDatePicker', SubmitType::class, ['label' => 'Enregistrer']);
    }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         // Configure your form options here
    //     ]);
    // }
}
