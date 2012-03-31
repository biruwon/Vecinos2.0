<?php
namespace Vecinos\IncidenciaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class IncidenciaAdmin extends Admin
{
    
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
           ->addIdentifier('titulo', null, array('label' => 'Título'))
           ->add('descripcion')
           ->add('fecha')
           ->add('hora')
           ->addIdentifier('resuelta', null, array('label' => 'Resuelta'))
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('titulo')
            #->add('fecha')
            #->add('hora')
            ->add('resuelta')
            ->add('descripcion')    
        ;
    }
    
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper
            ->add('titulo')
            ->add('descripcion')
            ->add('fecha')
            ->add('hora')
            ->add('resuelta')
        ;
    }



    
}


?>
