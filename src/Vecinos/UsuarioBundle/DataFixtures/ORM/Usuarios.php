<?php

namespace Vecinos\UsuarioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vecinos\UsuarioBundle\Entity\Usuario;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Fixtures de la entidad Usuarios.
 * Crea 25 usuarios para poder probar la aplicación.
 */
class Usuarios extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
	return 3;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        //$reservas = $manager->getRepository('ReservaBundle:Reserva')->findAll(); 
        
        
        for($i = 0; $i < 25; $i++){
            
            $usuario = new Usuario();
            $usuario->setNombre($this->getNombre());
            $usuario->setApellidos($this->getApellidos());
            $usuario->setCiudad($this->getCiudades());
            $usuario->setDireccion('Calle Beja'.$i);
            
            $dni = substr(rand(), 0, 8);
            $usuario->setDni($dni.substr("TRWAGMYFPDXBNJZSQVHLCKE", strtr($dni, "XYZ", "012")%23, 1));
            
            $usuario->setEmail('usuario'.$i.'@localhost.com');
            $usuario->setFechaNacimiento(new \DateTime('now - '.rand(7000, 20000).' days'));
            
            $passwordEnClaro = 'usuario'.$i;
            $usuario->setSalt(md5(time()));
            $encoder = $this->container->get('security.encoder_factory')->getEncoder($usuario);
            $passwordCodificado = $encoder->encodePassword($passwordEnClaro, $usuario->getSalt());
            $usuario->setPassword($passwordCodificado);
            
            $usuario->setPermiteEmail(true);
      
      //           $usuario->setReservas($reservas[$i]);
            
            $manager->persist($usuario);
          
        }
      
      
        
       //$manager->persist($usuario);
        
        $manager->flush();
        
         /*
         $usuarios = $manager->getRepository('UsuarioBundle:Usuario')->findAll(); 
       
        $usuarios[4]->setReservas($reservas[0]);
        $usuarios[14]->setReservas($reservas[1]);
        $usuarios[21]->setReservas($reservas[2]);
        $usuarios[2]->setReservas($reservas[3]);
        $manager->persist($usuarios[4]);
        $manager->persist($usuarios[14]);
        $manager->persist($usuarios[21]);
        $manager->persist($usuarios[2]);
         $manager->flush();
          * 
          */
    }
    
    
    /**
     * Generador aleatorio de nombres de personas
     * Aproximadamente genera un 50% de hombres y un 50% de mujeres
     */
    
    private function getNombre()
    {
        // Los nombres más populares en España 
        
        $hombres = array('Antonio', 'José', 'Manuel', 'Francisco', 'Juan', 'David', 'José Antonio', 'José Luis', 'Jesús', 'Javier', 'Francisco Javier', 'Carlos', 'Daniel', 'Miguel', 'Rafael', 'Pedro', 'José Manuel', 'Ángel', 'Alejandro', 'Miguel Ángel', 'José María', 'Fernando', 'Luis', 'Sergio', 'Pablo', 'Jorge', 'Alberto');
        $mujeres = array('María Carmen', 'María', 'Carmen', 'Josefa', 'Isabel', 'Ana María', 'María Dolores', 'María Pilar', 'María Teresa', 'Ana', 'Francisca', 'Laura', 'Antonia', 'Dolores', 'María Angeles', 'Cristina', 'Marta', 'María José', 'María Isabel', 'Pilar', 'María Luisa', 'Concepción', 'Lucía', 'Mercedes', 'Manuela', 'Elena', 'Rosa María');
        
        if (rand() % 2) {
            return $hombres[rand(0, count($hombres)-1)];
        }
        else {
            return $mujeres[rand(0, count($mujeres)-1)];
        }
    }
    
    /**
     * Generador aleatorio de apellidos de personas
     */
    private function getApellidos()
    {
        // Los apellidos más populares en España 
        
        $apellidos = array('García', 'González', 'Rodríguez', 'Fernández', 'López', 'Martínez', 'Sánchez', 'Pérez', 'Gómez', 'Martín', 'Jiménez', 'Ruiz', 'Hernández', 'Díaz', 'Moreno', 'Álvarez', 'Muñoz', 'Romero', 'Alonso', 'Gutiérrez', 'Navarro', 'Torres', 'Domínguez', 'Vázquez', 'Ramos', 'Gil', 'Ramírez', 'Serrano', 'Blanco', 'Suárez', 'Molina', 'Morales', 'Ortega', 'Delgado', 'Castro', 'Ortíz', 'Rubio', 'Marín', 'Sanz', 'Iglesias', 'Nuñez', 'Medina', 'Garrido');
        
        return $apellidos[rand(0, count($apellidos)-1)].' '.$apellidos[rand(0, count($apellidos)-1)];
    }
    
    
    
    /**
     * Generador aleatorio de ciudades de personas
     */
    private function getCiudades()
    {
        
        $ciudades = array('Sevilla', 'Madrid', 'Barcelona', 'Valencia', 'Bilbao', 'Pamplona', 'A coruña', 'Salamanca', 'Huelva', 'Cádiz', 'Málaga', 'Córdoba', 'Murcia', 'Granada', 'Jaén', 'Almeria', 'Cáceres', 'Badajoz', 'Logroño', 'Álbacete', 'Vitoria', 'San Sebastián', 'Tarrogona', 'Ceuta', 'Zaragoza', 'León', 'Huesca', 'Ciudad Real', 'Toledo');
        
        return $ciudades[rand(0, count($ciudades)-1)];
    }
}