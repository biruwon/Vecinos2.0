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
	  array('usuario' => $usuarios[11], 'titulo' => 'Depuradora no funciona', 'resuelta' => 'true', 'descripcion' => 'La piscina no funciona debido a ...', 'fecha' => '2011-10-12',
          'hora' => new \DateTime('7:45:50'),'tags' => 'jardineria','gravedad' => 'media','archivos' => array(null)),
          array('usuario' => $usuarios[11], 'titulo' => 'Ascensor no funciona', 'resuelta' => 'false', 'descripcion' => 'No funciona desde el Viernes pasado', 'fecha' => '2011-02-23',
          'hora' => new \DateTime('17:45:50'),'tags' => 'jardineria','gravedad' => 'media','archivos' => array(null)),
          array('usuario' => $usuarios[11], 'titulo' => 'Las luces de los pasillos no estan reguladas', 'resuelta' => 'false', 'descripcion' => ' ...', 'fecha' => '2011-03-10',
          'hora' => new \DateTime('20:45:50'),'tags' => 'jardineria','gravedad' => 'media','archivos' => array(null)),
          array('usuario' => $usuarios[11], 'titulo' => 'Se ha roto la red de pádel de la pista 3', 'resuelta' => 'true', 'descripcion' => 'Red rota', 'fecha' => '2011-06-07',
          'hora' => new \DateTime('5:45:50'),'tags' => 'jardineria','gravedad' => 'media','archivos' => array(null))
            );

            foreach ($incidencias as $incidencia) {
	    $entidad = new Incidencia();
            $entidad->setUsuario($incidencia['usuario']);
            $entidad->setTitulo($incidencia['titulo']);
            $entidad->setResuelta($incidencia['resuelta']);
            $entidad->setDescripcion($incidencia['descripcion']);
            $entidad->setHora($incidencia['hora']);
            $entidad->setTags($incidencia['tags']);
            $entidad->setFecha($incidencia['fecha']);
            $entidad->setGravedad($incidencia['gravedad']);
            $entidad->setArchivos($incidencia['archivos']);
            
            $manager->persist($entidad);
        }
        
        $manager->flush();
    }
}