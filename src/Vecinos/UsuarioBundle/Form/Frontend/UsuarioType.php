<?php

namespace Vecinos\UsuarioBundle\Form\Frontend;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

/**
 * Formulario para crear y manipular entidades de tipo Usuario.
 * Como se utiliza en la parte pública del sitio, algunas propiedades de
 * la entidad no se incluyen en el formulario.
 */
class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('email', 'email')
            
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'options' => array('label' => 'Contraseña'),
                'required' => false
            ))
            
            ->add('direccion')
            ->add('permite_email', 'checkbox', array('required' => false))
            ->add('fecha_nacimiento', 'birthday')
            ->add('dni')
            ->add('ciudad')    
            
            #->add('ciudad', 'entity', array(
            #    'class' => 'Cupon\\CiudadBundle\\Entity\\Ciudad',
            #   'empty_value' => 'Selecciona una ciudad',
            #    'query_builder' => function(EntityRepository $repositorio) {
            #        return $repositorio->createQueryBuilder('c')
            #            ->orderBy('c.nombre', 'ASC');
            #   },
           # ))
        ;
    }
    
    public function getName()
    {
        return 'frontend_usuario';
    }
}