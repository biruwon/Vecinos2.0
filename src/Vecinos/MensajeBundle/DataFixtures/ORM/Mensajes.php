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
	  array('emisor' => $usuarios[17], 'receptor' => $usuarios[7], 'texto' => 'Tenemos pista de pádel mañana', 'fecha' => new \DateTime('2011-10-12'),
          'hora' => new \DateTime('7:45:50')),array('emisor' => $usuarios[1], 'receptor' => $usuarios[11], 'texto' => '¿Te apetece salir hoy a tomar algo?', 'fecha' => new \DateTime('2012-01-03'),
          'hora' => new \DateTime('19:23:14')),array('emisor' => $usuarios[3], 'receptor' => $usuarios[5], 'texto' => 'Has hablado con el presidente sobre los presupuestos', 'fecha' => new \DateTime('2011-12-20'),
          'hora' => new \DateTime('13:15:00')),array('emisor' => $usuarios[6], 'receptor' => $usuarios[3], 'texto' => '¿Qué tal estás? Me ha dicho Mary que estabas mal del estomago?', 'fecha' => new \DateTime('2012-03-21'),
          'hora' => new \DateTime('12:05:00')),array('emisor' => $usuarios[16], 'receptor' => $usuarios[15], 'texto' => 'Marta quería hablar contigo, llamala!', 'fecha' => new \DateTime('2012-10-12'),
          'hora' => new \DateTime('19:35:21')),array('emisor' => $usuarios[14], 'receptor' => $usuarios[9], 'texto' => 'Feliz año nuevo', 'fecha' => new \DateTime('2011-12-31'),
          'hora' => new \DateTime('21:08:20'))
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