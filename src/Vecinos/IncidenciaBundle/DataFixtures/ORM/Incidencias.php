<?php

namespace Vecinos\IncidenciaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vecinos\IncidenciaBundle\Entity\Incidencia;
//use Comunidad\UsersBundle\Entity\Usuario;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Fixtures de la entidad Incidencia.
 * Crea incidencias para poder probar la aplicación.
 */
class Incidencias extends AbstractFixture implements OrderedFixtureInterface
{
    
    public function getOrder()
    {
	return 4;
    }



    public function load(ObjectManager $manager)
    {

        $usuarios = $manager->getRepository('UsuarioBundle:Usuario')->findAll();
    

	$incidencias = array(
	  array('usuario' => $usuarios[11], 'titulo' => 'Depuradora no funciona', 'resuelta' => 'true', 'descripcion' => 'La piscina no funciona debido a ...', 'fecha' => new \DateTime('2011-10-12'),
          'hora' => new \DateTime('7:45:50'))
            );

        foreach ($incidencias as $incidencia) {
	    $entidad = new Incidencia();
            $entidad->setUsuario($incidencia['usuario']);
            $entidad->setTitulo($incidencia['titulo']);
            $entidad->setResuelta($incidencia['resuelta']);
            $entidad->setDescripcion($incidencia['descripcion']);
            $entidad->setHora($incidencia['hora']);
            $entidad->setFecha($incidencia['fecha']);
            
            $manager->persist($entidad);
        }
        
        $manager->flush();
    }
}