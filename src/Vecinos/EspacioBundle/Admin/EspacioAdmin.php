<?php
namespace Vecinos\EspacioBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class EspacioAdmin extends Admin
{
    
    protected function configureListFields(ListMapper $mapper)
    {
        $mapper
           ->addIdentifier('nombre', null, array('label' => 'Nombre'))
           ->add('descripcion')
           
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('descripcion')
            ->add('nombre')
        ;
    }
    
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper
            ->add('descripcion')
            ->add('nombre')
        ;
    }



    
}


?>
