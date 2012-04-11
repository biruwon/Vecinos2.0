<?php
namespace Vecinos\InmuebleBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class InmuebleAdmin extends Admin
{
    
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
           ->add('num_personas')
           ->add('via')
           ->add('nombre_via')
           ->add('numero')
           ->add('bloque')
           ->add('puerta')
           ->add('planta')
           ->add('usuario_propietario')
           ->add('habitaciones')
           ->add('ocupado')
           ->add('usuarios')    
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('nombre_via')
            ->add('usuario_propietario')
            ->add('ocupado')    
        ;
    }
    
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper
           ->add('num_personas')
           ->add('via')
           ->add('nombre_via')
           ->add('numero')
           ->add('bloque')
           ->add('puerta')
           ->add('planta')
           ->add('usuario_propietario')
           ->add('habitaciones')
           ->add('ocupado')
           ->add('usuarios')
        ;
    }

      

    
}


?>
