<?php

namespace Vecinos\EspacioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vecinos\ReservaBundle\Entity\Reserva;

class espacios extends AbstractFixture implements OrderedFixtureInterface
{
    
    public function getOrder()
    {
	#return 1;
    }
    
    public function load(ObjectManager $manager)
    {
        $reservas = $manager->getRepository('ReservaBundle:Reserva')->findAll();
        
        
        $nombre_espacio = array();
        for ($i=0; $i<10; $i++) {
            $nombre_espacio = 'Espacio'+$i;
            printf($nombre_espacio);
        }
    }
    
    /**
     * Generador aleatorio de descripciones de ofertas
     */
    private function getDescripcion()
    {
        $descripcion = array();
        
        $frases = array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'Mauris ultricies nunc nec sapien tincidunt facilisis.',
            'Nulla scelerisque blandit ligula eget hendrerit.',
            'Sed malesuada, enim sit amet ultricies semper, elit leo lacinia massa, in tempus nisl ipsum quis libero.',
            'Aliquam molestie neque non augue molestie bibendum.',
            'Pellentesque ultricies erat ac lorem pharetra vulputate.',
            'Donec dapibus blandit odio, in auctor turpis commodo ut.',
            'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'Nam rhoncus lorem sed libero hendrerit accumsan.',
            'Maecenas non erat eu justo rutrum condimentum.',
            'Suspendisse leo tortor, tempus in lacinia sit amet, varius eu urna.',
            'Phasellus eu leo tellus, et accumsan libero.',
            'Pellentesque fringilla ipsum nec justo tempus elementum.',
            'Aliquam dapibus metus aliquam ante lacinia blandit.',
            'Donec ornare lacus vitae dolor imperdiet vitae ultricies nibh congue.',
        );
        
        $numeroFrases = rand(4, 7);
        
        for ($i=0; $i<$numeroFrases; $i++) {
            $descripcion[] = $frases[rand(0, count($frases)-1)];
        }
        
        return implode("\n", $descripcion);
    }
}
?>
