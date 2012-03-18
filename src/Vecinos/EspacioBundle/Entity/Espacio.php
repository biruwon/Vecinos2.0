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
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="espacio")
     */
    
    
    private $reservas;

   
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
     * Set reservas
     *
     * @param @param Vecinos\ReservaBundle\Entity\Reserva $reservas
     */
    public function setReservas($reservas)
    {
        $this->reservas = $reservas;
    }


    /**
     * Get reservas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getReservas()
    {
        return $this->reservas;
    }
}