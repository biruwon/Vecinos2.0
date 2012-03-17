<?php

namespace Vecinos\JuntaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('JuntaBundle:Default:index.html.twig', array('name' => $name));
    }
}
