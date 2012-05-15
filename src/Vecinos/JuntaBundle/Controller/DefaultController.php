<?php

namespace Vecinos\JuntaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vecinos\JuntaBundle\Entity\Junta;
use Vecinos\JuntaBundle\Form\Frontend\JuntaType;

class DefaultController extends Controller {

    /**
     * Muestra el formulario para crear una nueva junta y se encarga del
     * procesamiento de la información recibida y la creación de las nuevas
     * entidades de tipo Junta
     */
    public function juntaNuevaAction() {

        $peticion = $this->getRequest();
        $nombre_pdf = uniqid('vecinos-') . '-junta.pdf';
        $em = $this->getDoctrine()->getEntityManager();

        $junta = new Junta();
        //$path = $this->container->getParameter('vecinos.directorio.pdfs');
        //$junta->setPath('/Vecinos2.0/web/pdfs/' . $nombre_pdf);
        $junta->setPath($nombre_pdf);
        $junta->setHora1(new \DateTime('now'));
        $junta->setHora2(new \DateTime('now+30minutes'));

        //Para pasarle todos los usuarios por defecto
        $usuarios = $em->getRepository('UsuarioBundle:Usuario')->findTodosLosUsuarios();
        $junta->setUsuarios($usuarios);

        $formulario = $this->createForm(new JuntaType(), $junta);

        if ($peticion->getMethod() == 'POST') {
            $formulario->bindRequest($peticion);

            if ($formulario->isValid()) {

                /* $em->persist($junta);
                  $em->flush();
                  $id = $junta->getId();

                  return $this->redirect($this->generateUrl('usuario_junta_nueva_confirmacion', array(
                  'id'  => $id
                  ))); */

                $junta = $formulario->getData();
                if (!$junta) {
                    throw $this->createNotFoundException('La junta indicada no está disponible');
                }

                $session = $this->get("session");

                $session->set('junta', $junta);
                $session->save();

                $response = $this->forward('UsuarioBundle:Default:confirmacion', array(
                    'junta' => $junta
                        ));

                // adicionalmente modifica la respuesta o la devuelve directamente

                return $response;
            }
        }

        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            //throw new AccessDeniedException();
            throw $this->createNotFoundException(
                    'Solo un administrador puede crear una junta'
            );
        } else {
            return $this->render('JuntaBundle:Default:formulario.html.twig', array(
                        'accion' => 'crear',
                        'formulario' => $formulario->createView()
                    ));
        }
    }

}
