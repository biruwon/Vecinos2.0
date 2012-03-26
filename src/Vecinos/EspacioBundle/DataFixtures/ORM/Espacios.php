<?php

namespace Vecinos\EspacioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vecinos\EspacioBundle\Entity\Espacio;
//use Vecinos\ReservaBundle\Entity\Reserva;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures de la entidad Reservas.
 * Crea algunas reservas para poder probar la aplicación.
 */
class Espacios extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
	return 1;
    }


    public function load(ObjectManager $manager)
    {
        //$usuarios = $manager->getRepository('UsuarioBundle:Usuario')->findAll();
    
        $espacios = array(
	  array('descripcion' => 'Pista de cesped', 'nombre' => 'fútbol7')
   //	  array('horainicio' => new \DateTime('12:45:00'), 'horafin' => new \DateTime('13:45:00'), 'espacio' => 'piscina','usuario' => array($usuarios[10], $usuarios[17], $usuarios[14])),
   //       array('horainicio' => new \DateTime('20:45:00'), 'horafin' => new \DateTime('21:45:00'), 'espacio' => 'padel','usuario' => array($usuarios[15], $usuarios[7], $usuarios[9])),
   //       array('horainicio' => new \DateTime('22:45:00'), 'horafin' => new \DateTime('23:45:00'), 'espacio' => 'baloncesto','usuario' => array($usuarios[18], $usuarios[3], $usuarios[5])),
            );
        
        
        

        foreach ($espacios as $espacio) {
	    $entidad = new Espacio();
            $entidad->setDescripcion($espacio['descripcion']);
	    $entidad->setNombre($espacio['nombre']);
	    //$entidad->setEspacio($reserva['espacio']);
	    //$entidad->setUsuario($reserva['usuario']);  

            $manager->persist($entidad);
        }
        
        $manager->flush();
    }     
}