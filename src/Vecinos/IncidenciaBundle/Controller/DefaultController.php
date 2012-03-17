<?php

namespace Vecinos\IncidenciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('IncidenciaBundle:Default:index.html.twig', array('name' => $name));
    }
}
