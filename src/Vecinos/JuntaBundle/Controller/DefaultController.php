<?php

namespace Vecinos\JuntaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vecinos\JuntaBundle\Entity\Junta;
use Vecinos\JuntaBundle\Form\Frontend\JuntaType;



class DefaultController extends Controller
{
    
    /**
     * Muestra el formulario para crear una nueva junta y se encarga del
     * procesamiento de la información recibida y la creación de las nuevas
     * entidades de tipo Junta
     */
    public function juntaNuevaAction()
    {
        $peticion = $this->getRequest();
        
        $junta = new Junta();
        $formulario = $this->createForm(new JuntaType(), $junta);
        
        if ($peticion->getMethod() == 'POST') {
           $formulario->bindRequest($peticion);

           if ($formulario->isValid()) {
               
               $em = $this->getDoctrine()->getEntityManager();
               $em->persist($junta);
               $em->flush();
               
               
               return $this->redirect($this->generateUrl('usuario_juntas'));
           }
       }
        
       if (false === $this->get('security.context')->isGranted('ROLE_ADMIN'))
        {
            //throw new AccessDeniedException();
           throw $this->createNotFoundException(
                'Solo un administrador puede crear una junta'
            );

        }
        else
        {
            return $this->render('JuntaBundle:Default:formulario.html.twig', array(
            'accion'     => 'crear',
            'formulario' => $formulario->createView()
        ));
        }
    }
}
