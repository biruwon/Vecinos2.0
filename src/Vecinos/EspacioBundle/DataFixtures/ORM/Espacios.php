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
	  array('descripcion' => 'Pista de cesped', 'nombre' => 'fútbol7'),
          array('descripcion' => 'Pista de cesped', 'nombre' => 'fútbol'),
          array('descripcion' => 'Pista de arena', 'nombre' => 'fútbol7'),
          array('descripcion' => 'Pista de cemento', 'nombre' => 'fútbolSala1'),
          array('descripcion' => 'Pista de cemento', 'nombre' => 'fútbolSala2'),
          array('descripcion' => 'Pista de parquet', 'nombre' => 'fútbolSala3'),
          array('descripcion' => 'Pista exterior', 'nombre' => 'Baloncesto1'),
          array('descripcion' => 'Pista exterior', 'nombre' => 'Baloncesto2'),
          array('descripcion' => 'Pista de cesped', 'nombre' => 'piscina'),
          array('descripcion' => 'Pista de cesped', 'nombre' => 'padel1'),
          array('descripcion' => 'Pista de cesped', 'nombre' => 'padel2'),
          array('descripcion' => 'Pista de cesped', 'nombre' => 'padel3'),
          array('descripcion' => 'Pista de cesped', 'nombre' => 'padel4')  
            
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