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