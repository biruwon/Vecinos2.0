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
	//return 2;
                  return 7;
    }


    public function load(ObjectManager $manager)
    {
        
        $espacios = $manager->getRepository('EspacioBundle:Espacio')->findAll();
        $usuarios = $manager->getRepository('UsuarioBundle:Usuario')->findAll();
    
        $reservas = array(
          array('horainicio' => new \DateTime('9:45:00'),'fecha' => new \DateTime('2011-07-05') , 'horafin' =>  new \DateTime('10:45:00'), 'espacio' => $espacios[0], 'usuario' => $usuarios[2]),
          array('horainicio' => new \DateTime('12:45:00'),'fecha' => new \DateTime('2012-01-01') , 'horafin' =>  new \DateTime('13:45:00'), 'espacio' => $espacios[2], 'usuario' => $usuarios[4]),
          array('horainicio' => new \DateTime('20:45:00'), 'fecha' => new \DateTime('2012-02-07') , 'horafin' =>  new \DateTime('21:45:00'), 'espacio' => $espacios[3], 'usuario' => $usuarios[6]),
          array('horainicio' => new \DateTime('22:45:00'), 'fecha' => new \DateTime('2012-02-21') , 'horafin' =>  new \DateTime('23:45:00'), 'espacio' => $espacios[6], 'usuario' => $usuarios[10]),
            );
        
        
        

        foreach ($reservas as $reserva) {
	    $entidad = new Reserva();
                      $entidad->setHorainicio($reserva['horainicio']);
	    $entidad->setHorafin($reserva['horafin']);
	    $entidad->setEspacio($reserva['espacio']);
	    $entidad->setFecha($reserva['fecha']);
                      $entidad->setUsuario($reserva['usuario']);  

            $manager->persist($entidad);
        }
        
        $manager->flush();
    }     
}