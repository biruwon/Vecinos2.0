<?php

namespace Vecinos\InmuebleBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vecinos\UsuarioBundle\Entity\Usuario;
use Vecinos\InmuebleBundle\Entity\Inmueble;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Fixtures de la entidad Junta.
 * Crea juntas para poder probar la aplicación.
 */
class Inmuebles extends AbstractFixture implements OrderedFixtureInterface
{
    
    public function getOrder()
    {
	return 7;
    }



    public function load(ObjectManager $manager)
    {
        

	$usuarios = $manager->getRepository('UsuarioBundle:Usuario')->findAll();



	$inmuebles = array(
	  array('num_personas' => '3', 'ocupado' => 'true', 'via' => 'calle', 'nombre_via' => 'Beja', 'numero' => '45',
            'bloque' => '12', 'puerta' => 'A', 'planta' => '2', 'nombre_propietario' => 'Juan', 'habitaciones' => '2',
              'usuarios' => array($usuarios[10], $usuarios[13], $usuarios[14])),
          array('num_personas' => '3', 'ocupado' => 'true', 'via' => 'calle', 'nombre_via' => 'Beja', 'numero' => '3',
            'bloque' => '12', 'puerta' => 'A', 'planta' => '2', 'nombre_propietario' => 'Juan', 'habitaciones' => '2',
              'usuarios' => array($usuarios[1], $usuarios[2], $usuarios[3])),
          array('num_personas' => '2', 'ocupado' => 'true', 'via' => 'calle', 'nombre_via' => 'Beja', 'numero' => '45',
            'bloque' => '12', 'puerta' => 'A', 'planta' => '2', 'nombre_propietario' => 'Juan', 'habitaciones' => '2',
              'usuarios' => array($usuarios[4], $usuarios[5])),
          array('num_personas' => '3', 'ocupado' => 'true', 'via' => 'calle', 'nombre_via' => 'Beja', 'numero' => '45',
            'bloque' => '12', 'puerta' => 'A', 'planta' => '2', 'nombre_propietario' => 'Juan', 'habitaciones' => '2',
              'usuarios' => array($usuarios[7], $usuarios[8], $usuarios[9])),
          array('num_personas' => '5', 'ocupado' => 'true', 'via' => 'calle', 'nombre_via' => 'Beja', 'numero' => '45',
            'bloque' => '12', 'puerta' => 'A', 'planta' => '2', 'nombre_propietario' => 'Juan', 'habitaciones' => '2',
              'usuarios' => array($usuarios[15], $usuarios[16], $usuarios[17], $usuarios[18], $usuarios[19])),
          array('num_personas' => '3', 'ocupado' => 'true', 'via' => 'calle', 'nombre_via' => 'Beja', 'numero' => '45',
            'bloque' => '12', 'puerta' => 'A', 'planta' => '2', 'nombre_propietario' => 'Juan', 'habitaciones' => '2',
              'usuarios' => array($usuarios[20], $usuarios[21], $usuarios[22])),
          array('num_personas' => '1', 'ocupado' => 'true', 'via' => 'calle', 'nombre_via' => 'Beja', 'numero' => '45',
            'bloque' => '12', 'puerta' => 'A', 'planta' => '2', 'nombre_propietario' => 'Juan', 'habitaciones' => '2',
              'usuarios' => array($usuarios[23])),
          array('num_personas' => '1', 'ocupado' => 'true', 'via' => 'calle', 'nombre_via' => 'Beja', 'numero' => '45',
            'bloque' => '12', 'puerta' => 'A', 'planta' => '2', 'nombre_propietario' => 'Juan', 'habitaciones' => '2',
              'usuarios' => array($usuarios[24], $usuarios[0]))

            );

        foreach ($inmuebles as $inmueble) {
	    $entidad = new Inmueble();
            $entidad->setNumPersonas($inmueble['num_personas']);
            $entidad->setOcupado($inmueble['ocupado']);
            $entidad->setVia($inmueble['via']);
            $entidad->setNombreVia($inmueble['nombre_via']);
            $entidad->setNumero($inmueble['numero']);
            $entidad->setBloque($inmueble['bloque']);
            $entidad->setPuerta($inmueble['puerta']);
            $entidad->setPlanta($inmueble['planta']);
            $entidad->setNombrePropietario($inmueble['nombre_propietario']);
            $entidad->setHabitaciones($inmueble['habitaciones']);
            $entidad->setUsuarios($inmueble['usuarios']);
            
            
            $manager->persist($entidad);
        }
        
        $manager->flush();
    }
}