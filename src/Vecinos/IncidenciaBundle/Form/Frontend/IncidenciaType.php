<?php

namespace Vecinos\IncidenciaBundle\Form\Frontend;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class IncidenciaType extends AbstractType
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
            ->add('gravedad','choice', array('choices' => array('leve' => 'leve', 'media' => 'media','grave' => 'grave')))
           // ->add('foto', 'file', array('required' => false))
            ->add('archivos', 'collection', array(
                'type'      => 'file',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'options'=>array(
                    'required'  => false,
                    'attr'  => array('class' => 'unidades'),
                )))    
                
            ->add('fecha', 'date', array(
                'attr' => array('class' => 'date'),
                'widget' => 'single_text',
                'input' => 'string',
                'format' => 'dd/MM/yyyy', //\IntlDateFormatter::FULL
            ))
         
                    
            /*->add('foto', 'collection', array(
                'type'      => 'file',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'options'=>array(
                    'required'  => false,
                    'attr'  => array('class' => 'unidades'),
                )))    */
            ->add('hora')
        ;
     
     }
        
    public function getName()
    {

        return 'nueva_incidencia';
    }
}

?>
