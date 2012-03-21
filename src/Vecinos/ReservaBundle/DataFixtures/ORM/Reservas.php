<?php

namespace Vecinos\ReservaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vecinos\UsuarioBundle\Entity\Usuario;
use Vecinos\ReservaBundle\Entity\Reserva;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures de la entidad Reservas.
 * Crea algunas reservas para poder probar la aplicación.
 */
class Reservas extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
	return 2;
    }


    public function load(ObjectManager $manager)
    {
        
        $espacios = $manager->getRepository('EspacioBundle:Espacio')->findAll();
    
        $reservas = array(
	  array('horainicio' => new \DateTime('9:45:00'), 'horafin' =>  new \DateTime('10:45:00'), 'espacio' => $espacios[0])
   //	  array('horainicio' => new \DateTime('12:45:00'), 'horafin' => new \DateTime('13:45:00'), 'espacio' => 'piscina','usuario' => array($usuarios[10], $usuarios[17], $usuarios[14])),
   //       array('horainicio' => new \DateTime('20:45:00'), 'horafin' => new \DateTime('21:45:00'), 'espacio' => 'padel','usuario' => array($usuarios[15], $usuarios[7], $usuarios[9])),
   //       array('horainicio' => new \DateTime('22:45:00'), 'horafin' => new \DateTime('23:45:00'), 'espacio' => 'baloncesto','usuario' => array($usuarios[18], $usuarios[3], $usuarios[5])),
            );
        
        
        

        foreach ($reservas as $reserva) {
	    $entidad = new Reserva();
            $entidad->setHorainicio($reserva['horainicio']);
	    $entidad->setHorafin($reserva['horafin']);
	    $entidad->setEspacio($reserva['espacio']);
	  //  $entidad->setUsuario($reserva['usuario']);  

            $manager->persist($entidad);
        }
        
        $manager->flush();
    }     
}