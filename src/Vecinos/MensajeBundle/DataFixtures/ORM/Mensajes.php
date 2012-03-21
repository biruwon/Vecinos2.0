<?php

namespace Vecinos\MensajeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vecinos\UsuarioBundle\Entity\Usuario;
use Vecinos\MensajeBundle\Entity\Mensaje;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Fixtures de la entidad Mensaje.
 * Crea mensajes para poder probar la aplicación.
 */
class Mensajes extends AbstractFixture implements OrderedFixtureInterface
{
    
    public function getOrder()
    {
	return 5;
    }



    public function load(ObjectManager $manager)
    {

        $usuarios = $manager->getRepository('UsuarioBundle:Usuario')->findAll();
    

	$mensajes = array(
	  array('emisor' => $usuarios[17], 'receptor' => $usuarios[7], 'texto' => 'Eguiluz no tiene cara', 'fecha' => new \DateTime('2011-10-12'),
          'hora' => new \DateTime('7:45:50'))
            );

        foreach ($mensajes as $mensaje) {
	    $entidad = new Mensaje();
            $entidad->setEmisor($mensaje['emisor']);
            $entidad->setReceptor($mensaje['receptor']);
            $entidad->setTexto($mensaje['texto']);
            $entidad->setFecha($mensaje['fecha']);
            $entidad->setHora($mensaje['hora']);
            
            $manager->persist($entidad);
        }
        
        $manager->flush();
    }
}