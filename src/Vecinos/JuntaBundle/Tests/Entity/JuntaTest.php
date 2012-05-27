<?php

namespace Vecinos\JuntaBundle\Tests;

use Symfony\Component\Validator\ValidatorFactory;
use Vecinos\JuntaBundle\Entity\Junta;
use Vecinos\UsuarioBundle\Entity\Usuario;

/**
 * Test unitario para asegurar que la validación de la entidad Junta
 * funciona correctamente 
 */
class JuntaTest extends \PHPUnit_Framework_TestCase {

    private $validator;
    
    protected function setUp() {
        $this->validator = ValidatorFactory::buildDefault()->getValidator();
    }
    
    public function testValidarTitulo() {
        $junta = new Junta();
        //SUT
        $junta->setTitulo('Junta-de-prueba');
        $titulo = $junta->getTitulo();
        
        $this->assertEquals('Junta-de-prueba', $titulo, 'El slug se asigna automáticamente a partir del nombre');
    }
    
    public function testValidarDescripcion() {
        $junta = new Junta();
        $junta->setTitulo('Junta de prueba');
        $junta->setDescripcion('Descripción de prueba - Descripción de prueba - Descripción de prueba');
        //SUT
        /*list($errores, $error) = $this->validar($junta);
        
        $this->assertGreaterThan(0, count($errores), 'La descripción no puede dejarse en blanco');
        $this->assertEquals('This value should not be blank', $error->getMessageTemplate());
        $this->assertEquals('descripcion', $error->getPropertyPath());
        
        $junta->setDescripcion('Descripción de prueba');
        list($errores, $error) = $this->validar($junta);
        
        $this->assertGreaterThan(0, count($errores), 'La descripción debe tener al menos 30 caracteres');
        $this->assertRegExp("/This value is too short/", $error->getMessageTemplate());
        $this->assertEquals('descripcion', $error->getPropertyPath());*/
    }
    
    public function testValidarFechas() {
        $junta = new Junta();
        $junta->setTitulo('Junta de prueba');
        $junta->setDescripcion('Descripción de prueba - Descripción de prueba - Descripción de prueba');
        //SUT
        $junta->setFecha(new \DateTime('today'));
        /*list($errores, $error) = $this->validar($junta);
        
        $this->assertGreaterThan(0, count($errores), 'La fecha de expiración debe ser posterior a la fecha de publicación');
        $this->assertEquals('La fecha de expiración debe ser posterior a la fecha de publicación', $error->getMessageTemplate());
        $this->assertEquals('fechaValida', $error->getPropertyPath());*/
    }
    
    public function testValidarLugar(){
        $junta = new Junta();
        $junta->setTitulo('Junta de prueba');
        $junta->setDescripcion('Descripción de prueba - Descripción de prueba - Descripción de prueba');
        $junta->setFecha(new \DateTime('today'));

        $junta->setLugar('lugar-prueba');
        $lugar = $junta->getLugar();

        $this->assertEquals('lugar-prueba', $lugar, 'El lugar se guarda correctamente en la Junta');
    }
    
    public function testValidarusuario(){
        $junta = new Junta();
        $junta->setTitulo('Junta de prueba');
        $junta->setDescripcion('Descripción de prueba - Descripción de prueba - Descripción de prueba');
        $junta->setFecha(new \DateTime('today'));
        $junta->setLugar('lugar-prueba');
        //SUT
        $junta->setUsuarios($this->getusuario());
        $usuario = $junta->getUsuarios()->getNombre();
        
        $this->assertEquals('usuario de Prueba', $usuario, 'La usuario asociada a la Junta es de la misma ciudad en la que se vende la Junta');        
    }

    private function validar(Junta $junta){
        $errores = $this->validator->validate($junta);
        $error = $errores[0];
        
        return array($errores, $error);
    }
    
    
    private function getusuario() {
        $usuario = new usuario();
        $usuario->setNombre('usuario de Prueba');
        
        return $usuario;
    }

}
