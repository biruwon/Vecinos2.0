<?php

namespace Vecinos\JuntaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
     /** @test */
    public function laPortadaSimpleRedirigeAUnaCiudad()
    {
        $client = static::createClient();
        //SUT
        $crawler = $client->request('GET', '/');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode(),
            'Status 200 en portada'
        );
    }
    
    /** @test */
    /*public function laPortadaSoloMuestraUnaOfertaActiva()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $crawler = $client->followRedirect();
        //SUT        
        $ofertasActivas = $crawler->filter(
            'article.oferta section.descripcion a:contains("Comprar")'
        )->count();
        
        $this->assertEquals(1, $ofertasActivas,
            'La portada muestra una única oferta activa que se puede comprar'
        );
    }
    
    /** @test */
    public function losUsuariosPuedenRegistrarseDesdeLaPortada()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        //SUT
        $numeroEnlacesRegistrarse = $crawler->filter('html:contains("Regístrate")')->count();
        
        $this->assertGreaterThan(0, $numeroEnlacesRegistrarse,
            'La portada muestra al menos un enlace o botón para registrarse'
        );
    }
    
    /** @test */
    /*public function losUsuariosAnonimosVenLaCiudadPorDefecto()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $crawler = $client->followRedirect();
        //SUT
        $ciudadPorDefecto = $client->getContainer()->getParameter('cupon.ciudad_por_defecto');
        $ciudadPortada = $crawler->filter('header nav select option[selected="selected"]')->attr('value');
        
        $this->assertEquals($ciudadPorDefecto, $ciudadPortada,
            'La ciudad seleccionada en la portada de un usuario anónimo es la ciudad por defecto'
        );
    }
    
    /** @test */
    /*public function losUsuariosAnonimosNoPuedenComprar()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $crawler = $client->followRedirect();
        //SUT
        $comprar = $crawler->selectLink('Comprar')->link();
        $client->click($comprar);
        
        $this->assertTrue($client->getResponse()->isRedirect(),
            'Cuando un usuario anónimo intenta comprar, se le redirige al formulario de login'
        );
    }
    
    /** @test */
    /*public function losUsuariosAnonimosDebenLoguearseParaPoderComprar()
    {
        $pathLogin = '/.*\/usuario\/login_check/';
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        //SUT
        $entrar = $crawler->selectButton('Entrar');
        $crawler = $client->click($entrar);
        
        $this->assertRegExp($pathLogin, $crawler->filter('article form')->attr('action'),
            'Si intenta acceder a una ruta de la aplicación, le pide estar logueado'
        );
    }
    
    /** @test */
    public function laPortadaRequierePocasConsultasDeBaseDeDatos()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        //SUT
        if ($profiler = $client->getProfile()) {
            $this->assertLessThan(4, count($profiler->getCollector('db')->getQueries()),
                'La portada requiere menos de 4 consultas a la base de datos'
            );
        }
    }
    
    /** @test */
    public function laPortadaSeGeneraMuyRapido()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        
        if ($profiler = $client->getProfile()) {
            $this->assertLessThan(0.5, $profiler->getCollector('timer')->getTime(),
                'La portada se genera en menos de medio segundo'
            );
        }
    }    
}
