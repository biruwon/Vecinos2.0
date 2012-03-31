<?php
namespace Vecinos\ReservaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ReservaAdmin extends Admin
{
    
    protected function configureListFields(ListMapper $mapper)  
    {
        $mapper
           ->add('espacio')
           ->add('horainicio')
           ->add('horafin')
           ->addIdentifier('fecha', null, array('label' => 'Fecha'))
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('espacio')
           # ->add('fecha')
        ;
    }
    
    protected function configureFormFields(FormMapper $mapper)
    {
        $mapper
            ->with('Actividad')
                ->add('espacio')
            ->end()
            ->with('Hora y fecha')
                ->add('horainicio')
                ->add('horafin')
                ->add('fecha')
                
            ->end()

            ;
            

    }



    
}


?>
