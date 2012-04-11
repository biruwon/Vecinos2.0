<?php

namespace Vecinos\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Vecinos\UsuarioBundle\Entity\Usuario;
use Vecinos\ReservaBundle\Entity\Reserva;
use Vecinos\ReservaBundle\Entity\Junta;
use Vecinos\ReservaBundle\Entity\Inmueble;
use Vecinos\UsuarioBundle\Form\Frontend\UsuarioType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class DefaultController extends Controller
{
    
    /**
     * Muestra el formulario de login
     */
    public function loginAction()
    {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();
        
        $error = $peticion->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );
        
        return $this->render('UsuarioBundle:Default:login.html.twig', array(
            'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
            'error'         => $error
        ));
    }
    
    /**
     * Muestra la caja de login que se incluye en el lateral de la mayoría de páginas del sitio web.
     * Esta caja se transforma en información y enlaces cuando el usuario se loguea en la aplicación.
     * La respuesta se marca como privada para que no se añada a la cache pública. El trozo de plantilla
     * que llama a esta función se sirve a través de ESI
     *
     * @param string $id El valor del bloque `id` de la plantilla,
     *                   que coincide con el valor del atributo `id` del elemento <body>
     */
    public function cajaLoginAction($id = '')
    {
        $usuario = $this->get('security.context')->getToken()->getUser();
        
        $respuesta = $this->render('UsuarioBundle:Default:cajaLogin.html.twig', array(
            'id'      => $id,
            'usuario' => $usuario
        ));
        
        $respuesta->setMaxAge(30);
        
        return $respuesta;
    }
    
    /**
     * Muestra el formulario para que se registren los nuevos usuarios. Además
     * se encarga de procesar la información y de guardar la información en la base de datos
     */
    public function registroAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        
        $usuario = new Usuario();
        $usuario->setPermiteEmail(true);
        $usuario->setFechaNacimiento(new \DateTime('now - 18 years'));
        
        $formulario = $this->createForm(new UsuarioType(), $usuario);
        
        if ($peticion->getMethod() == 'POST') {
            
            $formulario->bindRequest($peticion);
            
            if ($formulario->isValid()) {
                // Completar las propiedades que el usuario no rellena en el formulario
                $usuario->setSalt(md5(time()));
                
                $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
                $passwordCodificado = $encoder->encodePassword(
                    $usuario->getPassword(),
                    $usuario->getSalt()
                );
                $usuario->setPassword($passwordCodificado);
                
                // Guardar el nuevo usuario en la base de datos
                $em->persist($usuario);
                $em->flush();
                
                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
                $this->get('session')->setFlash('info',
                    '¡Enhorabuena! Te has registrado correctamente en Cupon'
                );
                
                // Loguear al usuario automáticamente
                $token = new UsernamePasswordToken($usuario, $usuario->getPassword(), 'usuarios', $usuario->getRoles());
                $this->container->get('security.context')->setToken($token);
                
                
                return $this->redirect($this->generateUrl('portada'));
                
            }
        }
        
        return $this->render('UsuarioBundle:Default:registro.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }
    
    /**
     * Muestra el formulario con toda la información del perfil del usuario logueado.
     * También permite modificar la información y guarda los cambios en la base de datos
     */
    public function perfilAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        
        $usuario = $this->get('security.context')->getToken()->getUser();
        $formulario = $this->createForm(new UsuarioType(), $usuario);
        
        if ($peticion->getMethod() == 'POST') {
            $passwordOriginal = $formulario->getData()->getPassword();
            
            $formulario->bindRequest($peticion);
            
            if ($formulario->isValid()) {
                // Si el usuario no ha cambiado el password, su valor es null después
                // de hacer el ->bindRequest(), por lo que hay que recuperar el valor original
                if (null == $usuario->getPassword()) {
                    $usuario->setPassword($passwordOriginal);
                }
                // Si el usuario ha cambiado su password, hay que codificarlo antes de guardarlo
                else {
                    $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
                    $passwordCodificado = $encoder->encodePassword(
                        $usuario->getPassword(),
                        $usuario->getSalt()
                    );
                    $usuario->setPassword($passwordCodificado);
                }
                
                $em->persist($usuario);
                $em->flush();
                
                $this->get('session')->setFlash('info',
                    'Los datos de tu perfil se han actualizado correctamente'
                );
                return $this->redirect($this->generateUrl('usuario_perfil'));
            }
        }
        
        return $this->render('UsuarioBundle:Default:perfil.html.twig', array(
            'usuario'    => $usuario,
            'formulario' => $formulario->createView()
        ));
    }
    
    /**
     * Muestra todas las reservas del usuario logueado
     */
    public function reservasAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $this->get('security.context')->getToken()->getUser();
        
        
        $reservas = $em->getRepository('UsuarioBundle:Usuario')->findTodasLasReservas($usuario->getId());
        
        return $this->render('UsuarioBundle:Default:reservas.html.twig', array(
            'reservas'  => $reservas
        ));
    }
    

    public function incidenciasAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        //$usuario = $this->get('security.context')->getToken()->getUser();
        
        
        $incidencias = $em->getRepository('UsuarioBundle:Usuario')->findTodasLasIncidencias();
        
        return $this->render('UsuarioBundle:Default:incidencias.html.twig', array(
            'incidencias'  => $incidencias
        ));
    }
    
    
    public function aplicacionAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $this->get('security.context')->getToken()->getUser();
        
   
        return $this->render('UsuarioBundle:Default:aplicacion.html.twig'
        );
    }

    /**
     * Muestra todas las junstas del usuario logueado
     */
    public function juntasAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $this->get('security.context')->getToken()->getUser();
        
        
        $juntas = $em->getRepository('UsuarioBundle:Usuario')->findTodasLasJuntas($usuario->getId());
        
        return $this->render('UsuarioBundle:Default:juntas.html.twig', array(
            'juntas'  => $juntas
        ));
    }

}
