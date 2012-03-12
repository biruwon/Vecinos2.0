<?php

namespace Vecinos\InmuebleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('InmuebleBundle:Default:index.html.twig', array('name' => $name));
    }
}
