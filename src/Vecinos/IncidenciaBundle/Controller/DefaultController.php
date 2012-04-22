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
                $usuario = $this->get('security.context')->getToken()->getUser();
                $incidencia->setUsuario($usuario);
                
                $incidencia->subirFoto($this->container->getParameter('vecinos.directorio.imagenes'));
                if (null == $incidencia->getFoto()) {
                $incidencia->setFoto('sinfoto');
                }
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($incidencia);
                $em->flush();
                $this->get('session')->setFlash('incidencia',
                     'Nueva incidencia creada con éxito, se intentará resolver en las próximas horas.'
                
                );
                //kernel.root_dir apunta a /app
               // $documento = $this->container->getParameter('kernel.root_dir').'/../web/uploads/images/vecinos-4f8ee86cadbfc-foto1.jpg';
                
                $message = \Swift_Message::newInstance()
                
                //->attach(Swift_Attachment::fromPath($documento))
                //->attach((new Swift_Message_Attachment(new Swift_File(SF_ROOT_DIR.'/../uploads/images/vecinos-4f8ee86cadbfc-foto1.jpg'))))
                ->setFrom('vecinos200@gmail.com')
                ->setTo('ojosverdesdecristal@hotmail.com')
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