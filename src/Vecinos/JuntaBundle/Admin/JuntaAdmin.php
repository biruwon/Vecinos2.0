<?php
namespace Vecinos\JuntaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class JuntaAdmin extends Admin
{
    
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
           ->addIdentifier('fecha', null, array('label' => 'Fecha'))
           ->add('titulo')
           ->add('descripcion')
           ->add('lugar')
           ->add('hora1')
           ->add('hora2')
           ->add('usuarios')    
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('titulo')
            ->add('descripcion')
            ->add('duracion')    
        ;
    }
    
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper
           ->add('fecha')
           ->add('titulo')
           ->add('descripcion')
           ->add('lugar')
           ->add('hora1')
           ->add('hora2')
           ->add('usuarios')    
        ;
    }

      

    
}


?>
