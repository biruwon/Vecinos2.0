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
        $nombre_pdf = uniqid('vecinos-').'-junta.pdf';
         $em = $this->getDoctrine()->getEntityManager();
        
        $junta = new Junta();
        //$path = $this->container->getParameter('vecinos.directorio.pdfs');
        $junta->setPath('/Vecinos2.0/web/pdfs/'.$nombre_pdf);
        $junta->setHora1(new \DateTime('now'));
        $junta->setHora2(new \DateTime('now+30minutes'));
        
        //Para pasarle todos los usuarios por defecto
        $usuarios = $em->getRepository('UsuarioBundle:Usuario')->findTodosLosUsuarios();
        $junta->setUsuarios($usuarios);
        
        $formulario = $this->createForm(new JuntaType(), $junta);

        if ($peticion->getMethod() == 'POST') {
            $formulario->bindRequest($peticion);

            if ($formulario->isValid()) {

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
                $html = $this->renderView('JuntaBundle:Default:pdfjunta.html.twig', array('junta' => $junta));
// Print text using writeHTMLCell()
                $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more informatione 
                
                //$nombre_pdf = uniqid('vecinos-').'-junta.pdf';
                $pdf->Output(__DIR__ . '/../../../../web/pdfs/'.$nombre_pdf, 'F');

                //$em = $this->getDoctrine()->getEntityManager();
                $em->persist($junta);
                $em->flush();

                return $this->redirect($this->generateUrl('usuario_juntas'));
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
