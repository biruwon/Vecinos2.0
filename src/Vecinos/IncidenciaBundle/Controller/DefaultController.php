<?php

namespace Vecinos\IncidenciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Vecinos\IncidenciaBundle\Entity\Incidencia;
use Vecinos\IncidenciaBundle\Form\Frontend\IncidenciaType;
use Vecinos\UsuarioBundle\Entity\Usuario;

class DefaultController  extends Controller 
{
    
    public function incidenciaNuevaAction()
    {
        $peticion = $this->getRequest();
        
        $incidencia = new Incidencia();
        $incidencia->setHora(new \DateTime('now'));
        
        $formulario = $this->createForm(new IncidenciaType(), $incidencia);
        
        if ($peticion->getMethod() == 'POST') {
            $formulario->bindRequest($peticion);
            
            if ($formulario->isValid()) {
                $incidencia->setResuelta(false);
                $usuario = $this->get('security.context')->getToken()->getUser();
                $incidencia->setUsuario($usuario);
                $incidencia->setTags('jardin');
                
               // $incidencia->subirFoto($this->container->getParameter('vecinos.directorio.imagenes'));
                //if (null == $incidencia->getFoto()) {
                //$incidencia->setFoto('sinfoto');
                
                $incidencia->uploadVarios();

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($incidencia);
                $em->flush();
                $this->get('session')->setFlash('incidencia',
                     'Nueva incidencia creada con éxito, se intentará resolver en las próximas horas.'
                
                );
                //kernel.root_dir apunta a /app
               // $documento = $this->container->getParameter('kernel.root_dir').'/../web/uploads/images/'.$incidencia->getPath();
                
                /*$message = \Swift_Message::newInstance()
  
                ->addBcc($usuario->getEmail())
                ->setSubject($incidencia->getTitulo())
                ->setFrom('vecinos200@gmail.com')
                ->setTo('ojosverdesdecristal@hotmail.com')
                ->setBody($this->renderView('IncidenciaBundle:Default:incidencias.txt.twig', array('incidencia' => $incidencia)));
               // ->attach(\Swift_Attachment::fromPath($documento));
                //if ('sinfoto' != $incidencia->getFoto()) {
               // $message -> attach(\Swift_Attachment::fromPath($documento));
              //  }
              
                $this->get('mailer')->send($message);*/
            
                //le pasa al controlador de usuario_incidencias, que es UsuarioBundle:Default:incidencias , el usuario que creo la incidencia
                
            //    $this->renderView('UsuarioBundle:Default:incidencias.html.twig', array('arrayimagenes' => unserialize($incidencia->getPath()));
                return $this->redirect($this->generateUrl('usuario_incidencias'));
            }
          
        }
        return $this->render('IncidenciaBundle:Default:formulario.html.twig',array(
            'accion' => 'crear',
            'formulario' => $formulario->createView(), 
        ));
    
    }}
?>