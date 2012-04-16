<?php

namespace Vecinos\IncidenciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vecinos\IncidenciaBundle\Entity\Incidencia;
use Vecinos\IncidenciaBundle\Form\Frontend\IncidenciaType;

class DefaultController extends Controller
{

    public function incidenciaNuevaAction()
    {
        $peticion = $this->getRequest();
        
        $incidencia = new Incidencia();
        $formulario = $this->createForm(new IncidenciaType(), $incidencia);
        
        if ($peticion->getMethod() == 'POST') {
            $formulario->bindRequest($peticion);
            
            if ($formulario->isValid()) {
                $incidencia->setResuelta(false);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($incidencia);
                $em->flush();
                $this->get('session')->setFlash('incidencia',
                     'Nueva incidencia creada con éxito, se intentará resolver en las próximas horas.'
                
                );
                //kernel.root_dir apunta a /app
               // $documento = $this->getContainer()->getParameter('kernel.root_dir').'/web/apple-touch-icon.png';
                $message = \Swift_Message::newInstance()
                ->setSubject('Nueva incidencia en la comunidad')
                ->setFrom('vecinos200@gmail.com')
                ->setTo('ojosverdesdecristal@hotmail.com')
              //  ->attach(Swift_Attachment::fromPath($documento))
                ->setBody($this->renderView('IncidenciaBundle:Default:incidencias.txt.twig', array('incidencia' => $incidencia)));
                $this->get('mailer')->send($message);
            
                return $this->redirect($this->generateUrl('usuario_incidencias'));
            }
        }
        return $this->render('IncidenciaBundle:Default:formulario.html.twig',array(
            'accion' => 'crear',
            'formulario' => $formulario->createView()
        ));
    }
   
}
?>