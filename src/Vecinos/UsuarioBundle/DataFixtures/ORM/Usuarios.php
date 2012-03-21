<?php

namespace Vecinos\UsuarioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vecinos\UsuarioBundle\Entity\Usuario;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures de la entidad Usuarios.
 * Crea 20 usuarios para poder probar la aplicación.
 */
class Usuarios extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
	return 3;
    }


    public function load(ObjectManager $manager)
    {
        $reservas = $manager->getRepository('ReservaBundle:Reserva')->findAll(); 
        
        for($i = 0; $i < 20; $i++){
            
            $usuario = new Usuario();
            $usuario->setNombre($this->getNombre());
            $usuario->setApellidos($this->getApellidos());
            $usuario->setCiudad("Sevilla");
            $usuario->setDireccion("Calle Beja 33");
            $usuario->setDni("11111111H");
            $usuario->setEmail('usuario'.$i.'@localhost');
            $usuario->setFechaNacimiento(new \DateTime('now - '.rand(7000, 20000).' days'));
            $usuario->setPassword('usuario'.$i);
            $usuario->setPermiteEmail(true);
            $usuario->setSalt(md5(time()));
            $usuario->setReservas($reservas[$i]);
            
            $manager->persist($usuario);
          
        }
        
        $manager->flush();
    }
    
    
    /**
     * Generador aleatorio de nombres de personas
     * Aproximadamente genera un 50% de hombres y un 50% de mujeres
     */
    
    private function getNombre()
    {
        // Los nombres más populares en España según el INE
        // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm
        
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
        // Los apellidos más populares en España según el INE
        // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm
        
        $apellidos = array('García', 'González', 'Rodríguez', 'Fernández', 'López', 'Martínez', 'Sánchez', 'Pérez', 'Gómez', 'Martín', 'Jiménez', 'Ruiz', 'Hernández', 'Díaz', 'Moreno', 'Álvarez', 'Muñoz', 'Romero', 'Alonso', 'Gutiérrez', 'Navarro', 'Torres', 'Domínguez', 'Vázquez', 'Ramos', 'Gil', 'Ramírez', 'Serrano', 'Blanco', 'Suárez', 'Molina', 'Morales', 'Ortega', 'Delgado', 'Castro', 'Ortíz', 'Rubio', 'Marín', 'Sanz', 'Iglesias', 'Nuñez', 'Medina', 'Garrido');
        
        return $apellidos[rand(0, count($apellidos)-1)].' '.$apellidos[rand(0, count($apellidos)-1)];
    }
}