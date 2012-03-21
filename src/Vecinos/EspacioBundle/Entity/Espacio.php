<?php

namespace Vecinos\EspacioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Vecinos\EspacioBundle\Entity\Espacio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\EspacioBundle\Entity\EspacioRepository")
 */
class Espacio
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var text $descripcion
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    
    private $descripcion;
    
    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Vecinos\ReservaBundle\Entity\Reserva", mappedBy="espacio")
     */
    
    
    private $reservasEspacio;

   
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    
    public function __construct()
    {
      $this->reservas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNombre();
    }    
     

    /**
     * Set descripcion
     *
     * @param text $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * Get descripcion
     *
     * @return text 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set reservasEspacio
     *
     * @param @param Vecinos\ReservaBundle\Entity\Reserva $reservasEspacio
     */
    public function setReservasEspacio($reservasEspacio)
    {
        $this->reservasEspacio = $reservasEspacio;
    }


    /**
     * Get reservasEspacio
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getReservasEspacio()
    {
        return $this->reservasEspacio;
    }
}