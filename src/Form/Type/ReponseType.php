<?php
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

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         'data_class' => CreateQuestionCommand::class,
    //     ]);
    // }
}

/*

{{ form_start(form, {'attr': {'id': 'mon-formulaire-ajax'}}) }}
    {{ form_widget(form.content, {'attr': {'id': 'content1'}}) }}
    {{ form_widget(form.content, {'attr': {'id': 'content2'}}) }}
    {{ form_widget(form.content, {'attr': {'id': 'content3'}}) }}
{{ form_end(form) }}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var inputs = document.querySelectorAll('.auto-save');
        inputs.forEach(function(input) {
            input.addEventListener('change', function(e) {
                e.preventDefault();
                fetch(document.querySelector('#' + input.id).form.getAttribute('action'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(new FormData(document.querySelector('#' + input.id).form))
                })
                .then(response => response.json())
                .then(data => {
                    // Traitez la réponse du serveur ici
                });
            });
        });
    });
</script>


{{ form_start(form, {'attr': {'id': 'mon-formulaire-ajax'}, 'action': path('nom_de_la_route_du_controleur')}) }}
    {{ form_widget(form.content, {'attr': {'id': 'content1'}}) }}
    {{ form_widget(form.content, {'attr': {'id': 'content2'}}) }}
    {{ form_widget(form.content, {'attr': {'id': 'content3'}}) }}
{{ form_end(form) }}



*/