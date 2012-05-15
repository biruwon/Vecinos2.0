<?php

namespace Vecinos\JuntaBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Formulario para crear y manipular entidades de tipo Junta.
 * Como se utiliza en la extranet, algunas propiedades de la entidad
 * no se incluyen en el formulario.
 */
class JuntaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcion', 'textarea', array(
            'attr' => array(
            'class' => 'tinymce',
            'data-theme' => 'medium' // simple, advanced, bbcode
            )
            ))
            ->add('lugar')
            //->add('fecha')
            ->add('fecha', 'date', array(
                'attr' => array('class' => 'date'),
                'widget' => 'single_text',
                'input' => 'string',
                'format' => 'dd/MM/yyyy', //\IntlDateFormatter::FULL
            ))
            ->add('hora1')
            ->add('hora2')
            /*->add('hora1', 'time', array(
                'input' => 'string',
                'widget' => 'choice',
            ))*/
            /*->add('hora2', 'time', array(
                'input' => 'string',
                'widget' => 'choice',
            ))*/
            //->add('usuarios', null, array('required' => false))
        ;
        
    }

    public function getName()
    {
        return 'nueva_junta';
    }
}