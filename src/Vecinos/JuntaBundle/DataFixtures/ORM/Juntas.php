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
	  array('titulo' => 'Inicio de la Comunidad', 'descripcion' => 'Bienvenida a todos los nuevos inquilinos', 'fecha' => new \DateTime('2011-07-01'), 'hora' => new \DateTime('9:45:00'), 'duracion' => '45',
            'usuarios' => array($usuarios[0], $usuarios[3], $usuarios[4])),

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