<?php

namespace Vecinos\ReservaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Vecinos\ReservaBundle\Entity\Reserva
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\ReservaBundle\Entity\ReservaRepository")
 */
class Reserva
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
     * 
     * @ORM\Column(name="fecha", type="date")
     */
    
    private $fecha;
    
    
    
    /**
     * @var string $horainicio
     *
     * @ORM\Column(name="horainicio", type="time")
     */
    
    private $horainicio;
    
    /**
     * @var string $horafin
     *
     * @ORM\Column(name="horafin", type="time")
     */
    
    
    private $horafin;
    
    /**
     * @ORM\OneToOne(targetEntity="Vecinos\UsuarioBundle\Entity\Usuario", mappedBy="reservas")
     */
    
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Vecinos\EspacioBundle\Entity\Espacio", inversedBy="reservasEspacio", cascade={"remove"})
     * @ORM\JoinColumn(name="espacio_id", referencedColumnName="id")
     */

    private $espacio;
    

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
     // $this->reservas = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set horainicio
     *
     * @param time $horainicio
     */
    public function setHorainicio($horainicio)
    {
        $this->horainicio = $horainicio;
    }

    /**
     * Get horainicio
     *
     * @return time 
     */
    public function getHorainicio()
    {
        return $this->horainicio;
    }
    
    /**
     * Set horafin
     *
     * @param time $horafin
     */
    public function setHorafin($horafin)
    {
        $this->horafin = $horafin;
    }

    /**
     * Get fecha
     *
     * @return date 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
    
    /**
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get horafin
     *
     * @return time 
     */
    public function getHorafin()
    {
        return $this->horafin;
    }

    /**
     * Set usuario
     *
     * @param Vecinos\UsuarioBundle\Entity\Usuario $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get usuario
     *
     * @return Vecinos\UsuarioBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set espacio
     *
     * @param Vecinos\EspacioBundle\Entity\Espacio $espacio
     */
    public function setEspacio($espacio)
    {
        $this->espacio = $espacio;
    }

    /**
     * Get espacio
     *
     * @return Vecinos\EspacioBundle\Entity\Espacio 
     */
    public function getEspacio()
    {
        return $this->espacio;
    }
}