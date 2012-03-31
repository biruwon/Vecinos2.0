<?php
namespace Vecinos\MensajeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class MensajeAdmin extends Admin
{
    
    protected function configureListFields(ListMapper $mapper)  
    {
        $mapper
           ->add('emisor')
           ->add('receptor')
           ->add('texto')
           ->add('fecha')
           ->add('hora')
        ;
    }
    
    protected function configureDatagridFilters(DatagridMapper $mapper)
    {
        $mapper
            ->add('emisor')
            ->add('receptor')
        ;
    }
 
}


?>
