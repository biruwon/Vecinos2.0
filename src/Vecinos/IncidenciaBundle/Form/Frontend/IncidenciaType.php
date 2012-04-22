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
            ->add('descripcion')
            ->add('gravedad')
            ->add('fecha')
            ->add('foto', 'file', array('required' => false))
            ->add('hora')
        ;
     
     }
        
    public function getName()
    {

        return 'nueva_incidencia';
    }
}

?>
