<?php

namespace Vecinos\JuntaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vecinos\UsuarioBundle\Entity\Usuario;
use Vecinos\JuntaBundle\Entity\Junta;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Fixtures de la entidad Junta.
 * Crea juntas para poder probar la aplicación.
 */
class Juntas extends AbstractFixture implements OrderedFixtureInterface
{
    
    public function getOrder()
    {
	return 6;
    }



    public function load(ObjectManager $manager)
    {
        

	$usuarios = $manager->getRepository('UsuarioBundle:Usuario')->findAll();



	$juntas = array(
	  array('titulo' => 'Inicio de la Comunidad', 'descripcion' => 'Bienvenida a todos los nuevos inquilinos', 'fecha' => new \DateTime('2011-11-30'), 'hora' => new \DateTime('9:45:00'), 'duracion' => '45',
            'usuarios' => array($usuarios[0], $usuarios[3], $usuarios[4])),
          array('titulo' => 'Nuevo Inquilino', 'descripcion' => 'Bienvenida al nuevo inquilino del 4ºb', 'fecha' => new \DateTime('2011-07-01'), 'hora' => new \DateTime('9:45:00'), 'duracion' => '45',
            'usuarios' => array($usuarios[20], $usuarios[18], $usuarios[1])),
          array('titulo' => 'Normativa del segundo trimestre', 'descripcion' => 'Reglas y normas a cumplir por todos los vecinos', 'fecha' => new \DateTime('2012-01-21'), 'hora' => new \DateTime('14:15:00'), 'duracion' => '45',
            'usuarios' => array($usuarios[24], $usuarios[3], $usuarios[2])),
          array('titulo' => 'Contratación jardinero', 'descripcion' => 'Debate sobre la contratación o no de un trabajador para cuidar las zonas comunes de la comunidad', 'fecha' => new \DateTime('2011-07-01'), 'hora' => new \DateTime('16:30:00'), 'duracion' => '45',
            'usuarios' => array($usuarios[5], $usuarios[13], $usuarios[16], $usuarios[14], $usuarios[10])),
          array('titulo' => 'Servicios de Limpieza', 'descripcion' => 'Servicio de limpieza, tanto de las calles interiores como de los bloques', 'fecha' => new \DateTime('2012-04-02'), 'hora' => new \DateTime('12:20:00'), 'duracion' => '45',
            'usuarios' => array($usuarios[3], $usuarios[23], $usuarios[7], $usuarios[14])),

            );

        foreach ($juntas as $junta) {
	    $entidad = new Junta();
            $entidad->setTitulo($junta['titulo']);
            $entidad->setDescripcion($junta['descripcion']);
            $entidad->setFecha($junta['fecha']);
            $entidad->setHora($junta['hora']);
            $entidad->setDuracion($junta['duracion']);
            $entidad->setUsuarios($junta['usuarios']);
            
            $manager->persist($entidad);
        }
        
        $manager->flush();
    }
}