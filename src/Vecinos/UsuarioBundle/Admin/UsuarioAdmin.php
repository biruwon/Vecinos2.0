<?php
namespace Vecinos\UsuarioBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class UsuarioAdmin extends Admin
{
    
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
           ->add('nombre')
           ->add('apellidos')
           ->add('direccion')
           ->add('ciudad')
           ->add('email')
           ->add('dni')
           ->add('fecha_nacimiento')
           ->add('inmuebles')
           
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('apellidos')
            ->add('nombre')
            ->add('ciudad')
            #->add('fecha_nacimiento')
        ;
    }
    
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper
            ->with('Datos Personales')
                ->add('nombre')
                ->add('apellidos')
                ->add('email', null, array('required' => false))
                ->add('dni')
                ->add('fecha_nacimiento')
                ->add('password')
                ->add('permite_email', null, array('required' => false))
                ->add('salt')
            ->end()
            ->with('Domicilio')
                ->add('direccion')
                ->add('ciudad')
                
            ->end()

            ;
            

    }



    
}


?>
