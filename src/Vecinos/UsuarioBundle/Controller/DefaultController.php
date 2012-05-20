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

class DefaultController extends Controller {

    /**
     * Muestra el formulario de login
     */
    public function loginAction() {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();

        $error = $peticion->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR, $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        if (true === $this->get('security.context')->isGranted('ROLE_USUARIO' || 'ROLE_ADMIN')) {
            //throw new AccessDeniedException();

            return $this->redirect($this->generateUrl('usuario_aplicacion'));
        } else {

            return $this->render('UsuarioBundle:Default:login.html.twig', array(
                        'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
                        'error' => $error
                    ));
        }
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
    public function cajaLoginAction($id = '') {
        $usuario = $this->get('security.context')->getToken()->getUser();

        $respuesta = $this->render('UsuarioBundle:Default:cajaLogin.html.twig', array(
            'id' => $id,
            'usuario' => $usuario
                ));

        $respuesta->setMaxAge(30);

        return $respuesta;
    }

    /**
     * Muestra el formulario para que se registren los nuevos usuarios. Además
     * se encarga de procesar la información y de guardar la información en la base de datos
     */
    public function registroAction() {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();

        $usuario = new Usuario();
        $usuario->setPermiteEmail(true);
        $usuario->setFechaNacimiento(new \DateTime('now - 18 years'));
        // Completar las propiedades que el usuario no rellena en el formulario
        $usuario->setRol(array('ROLE_USUARIO'));

        $formulario = $this->createForm(new UsuarioType(), $usuario);

        if ($peticion->getMethod() == 'POST') {

            $formulario->bindRequest($peticion);

            if ($formulario->isValid()) {

                $usuario->setSalt(md5(time()));
                $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
                $passwordCodificado = $encoder->encodePassword(
                        $usuario->getPassword(), $usuario->getSalt()
                );
                $usuario->setPassword($passwordCodificado);

                // Guardar el nuevo usuario en la base de datos
                $em->persist($usuario);
                $em->flush();

                // Crear un mensaje flash para notificar al usuario que se ha registrado correctamente
                $this->get('session')->setFlash('info', '¡Enhorabuena! Te has registrado correctamente en Cupon'
                );

                // Loguear al usuario automáticamente
                //$token = new UsernamePasswordToken($usuario, $usuario->getPassword(), 'usuarios', $usuario->getRoles());
                //$this->container->get('security.context')->setToken($token);


                return $this->redirect($this->generateUrl('usuario_aplicacion'));
            }
        }

        if (true === $this->get('security.context')->isGranted('ROLE_USUARIO' || 'ROLE_ADMIN')) {
            //throw new AccessDeniedException();

            return $this->redirect($this->generateUrl('usuario_aplicacion'));
        } else {

            return $this->render('UsuarioBundle:Default:registro.html.twig', array(
                        'formulario' => $formulario->createView()
                    ));
        }
    }

    /**
     * Muestra el formulario con toda la información del perfil del usuario logueado.
     * También permite modificar la información y guarda los cambios en la base de datos
     */
    public function perfilAction() {
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
                            $usuario->getPassword(), $usuario->getSalt()
                    );
                    $usuario->setPassword($passwordCodificado);
                }

                $em->persist($usuario);
                $em->flush();

                $this->get('session')->setFlash('info', 'Los datos de tu perfil se han actualizado correctamente'
                );
                return $this->redirect($this->generateUrl('usuario_perfil'));
            }
        }

        return $this->render('UsuarioBundle:Default:perfil.html.twig', array(
                    'usuario' => $usuario,
                    'formulario' => $formulario->createView()
                ));
    }
    
    
    /**
     *
     * Perfil del usuario que crea la incidencia 
     */
    public function perfilIncidenciaAction($id) {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();

        $usuario = $em->getRepository('UsuarioBundle:Usuario')->find($id);
        if (!$usuario) {
            throw $this->createNotFoundException('No se ha encontrado el usuario');
        }
        
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
                            $usuario->getPassword(), $usuario->getSalt()
                    );
                    $usuario->setPassword($passwordCodificado);
                }

                $em->persist($usuario);
                $em->flush();

                $this->get('session')->setFlash('info', 'Los datos de tu perfil se han actualizado correctamente'
                );
                return $this->redirect($this->generateUrl('usuario_perfil'));
            }
        }

        return $this->render('UsuarioBundle:Default:perfil.html.twig', array(
                    'usuario' => $usuario,
                    'formulario' => $formulario->createView()
                ));
    }

    /**
     * Muestra todas las reservas del usuario logueado
     */
    public function reservasAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $this->get('security.context')->getToken()->getUser();


        $reservas = $em->getRepository('UsuarioBundle:Usuario')->findTodasLasReservas($usuario->getId());

        return $this->render('UsuarioBundle:Default:reservas.html.twig', array(
                    'reservas' => $reservas
                ));
    }

    public function mostrarAction($id) {
        
        $em = $this->getDoctrine()->getEntityManager();

        $incidencia = $em->getRepository('IncidenciaBundle:Incidencia')->find($id);

        if (!$incidencia) {
            throw $this->createNotFoundException('No se ha encontrado la incidencia');
        }

        return $this->render('IncidenciaBundle:Default:mostrar.html.twig', array(
            'incidencia'      => $incidencia,
            'arrayimagenes' => unserialize($incidencia->getPath()),
        ));
        
    }
    
    
    public function incidenciasAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $paginador = $this->get('ideup.simple_paginator');
        
        $paginador->setItemsPerPage(5);

        $incidencias = $paginador->paginate(
                    $em->getRepository('UsuarioBundle:Usuario')->queryTodasLasIncidencias()
                    )->getResult();

       $formato = $this->get('request')->getRequestFormat();

       return $this->render('UsuarioBundle:Default:incidencias.' . $formato . '.twig', array(
                    'incidencias' => $incidencias,
                    'paginador' => $paginador
                ));
    }
    
    public function tagsAction($tag) {
        
        $em = $this->getDoctrine()->getEntityManager();
        $incidencias = $em->getRepository('IncidenciaBundle:Incidencia')->findIncidenciasByTag($tag);

        return $this->render('IncidenciaBundle:Default:incidenciasTag.html.twig', array(
                    'incidencias' => $incidencias
                ));
    }

    public function aplicacionAction() {
        //$em = $this->getDoctrine()->getEntityManager();
        //$usuario = $this->get('security.context')->getToken()->getUser();


        return $this->render('UsuarioBundle:Default:aplicacion.html.twig');
    }

    /**
     * Muestra todas las junstas del usuario logueado
     */
    public function juntasAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $this->get('security.context')->getToken()->getUser();
        
        $paginador = $this->get('ideup.simple_paginator');
        
        $paginador->setItemsPerPage(5);

        $juntas = $paginador->paginate(
                    $em->getRepository('UsuarioBundle:Usuario')->queryTodasLasJuntas($usuario->getId())
                    )->getResult();

        $formato = $this->get('request')->getRequestFormat();

        return $this->render('UsuarioBundle:Default:juntas.' . $formato . '.twig', array(
                    'juntas' => $juntas,
                    'paginador' => $paginador
                ));
    }

    public function confirmacionAction($junta) {
        $pdf = $this->container->get("white_october.tcpdf")->create();

//$pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Antonio Jesús');
        $pdf->SetTitle('PDF Vecinos2.0');
        $pdf->SetSubject('PDF Vecinos2.0');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);
// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//set some language-dependent strings
//$pdf->setLanguageArray($l);
// ---------------------------------------------------------
// set default font subsetting mode
        $pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

// Set some content to print
        /*                $html = <<<EOD
          <h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
          <i>This is the first example of TCPDF library.</i>
          <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
          <p>Please check the source code documentation and other examples for further information.</p>
          <p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
          EOD;
         */
        //$session = $this->getRequest()->getSession();
        //$request = $this->getRequest();
        //$junta = $request->get('junta');
        //$junta = $session->get('prueba');
        //$peticion = $this->getRequest();

          /*$junta = $em->getRepository('JuntaBundle:Junta')->findOneById($id);
          if (!$junta) {
          throw $this->createNotFoundException('La junta indicada no está disponible');
          }*/
          
          $em = $this->getDoctrine()->getEntityManager();
          $usuarios = $em->getRepository('UsuarioBundle:Usuario')->findAll(); 

          
        $html = $this->renderView('JuntaBundle:Default:pdfjunta.html.twig', array('junta' => $junta));

// Print text using writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more informatione 
        $nombre_pdf = $junta->getPath();
        $pdf->Output(__DIR__ . '/../../../../web/pdfs/' . $nombre_pdf, 'F');
        //$em = $this->getDoctrine()->getEntityManager();
        /* $em->persist($junta);
          $em->flush();
         */
        /* return $this->redirect($this->generateUrl('usuario_junta_nueva_confirmacion', array(
          'junta'  => $junta,
          'pdf' => $pdf
          ))); */
        /* $response = $this->forward('UsuarioBundle:Default:confirmacion', array(
          'junta'  => $junta,
          'pdf' => $pdf
          ));
          return $response; */
        return $this->render('JuntaBundle:Default:confirmacion.html.twig', array(
                    'junta' => $junta,
                    'usuarios' => $usuarios
                ));
    }

    public function juntaSiAction() {

        /* $em = $this->getDoctrine()->getEntityManager();

          $junta = $em->getRepository('JuntaBundle:Junta')->findOneById($id);
          if (!$junta) {
          throw $this->createNotFoundException('La junta indicada no está disponible');
          }
          $em->remove($junta);
          $em->flush(); */

        //$junta = $this->get('session')->getFlash('junta');
        $session  = $this->get('session');
        $junta = $session->get('junta');

        
        $em = $this->getDoctrine()->getEntityManager();
        $usuarios = $em->getRepository('UsuarioBundle:Usuario')->findTodosLosUsuarios();
        $junta->setUsuarios($usuarios);
        $nombre = $junta->getPath();
        
        $em->persist($junta);
        $em->flush();
        
        
        //kernel.root_dir apunta a /app
        $documento = $this->container->getParameter('kernel.root_dir').'/../web/pdfs/'.$junta->getPath();
      //  for ($i = 0; $i < sizeof($usuarios); ++$i) {
        $message = \Swift_Message::newInstance()
  
           //->addBcc($usuario->getEmail())
           ->setSubject($junta->getTitulo())
           ->setFrom('vecinos200@gmail.com')
           ->setTo('vecinos200@googlegroups.com') //el usuario debería estar subscrito a esa lista
           ->setBody('Nueva junta')
           ->attach(\Swift_Attachment::fromPath($documento));
           
              
                $this->get('mailer')->send($message);
        //}
        $session->clear();

        //return $this->redirect($this->generateUrl('usuario_juntas'));
        
        $response = $this->forward('SymplexDropboxBundle:Dropbox:pdfDropbox', array(
                    'nombre' => $nombre
                        ));
        return $response;
    }

}
