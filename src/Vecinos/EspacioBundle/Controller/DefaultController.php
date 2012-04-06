<?php

namespace Vecinos\EspacioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('EspacioBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function portadaAction()
    {
        return $this->render('EspacioBundle:Default:portada.html.twig');
    }
}
