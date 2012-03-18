<?php

namespace Vecinos\IncidenciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vecinos\IncidenciaBundle\Entity\Incidencia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\IncidenciaBundle\Entity\IncidenciaRepository")
 */
class Incidencia
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
     * @ORM\Column(type="string")
     */
    private $titulo;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $descripcion;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $fecha;
    
    /**
     * @ORM\Column(type="time")
     */
    protected $hora;
    
      /**
     * @var boolean $resuelta
     *
     * @ORM\Column(name="resuelta", type="boolean")
     */
    private $resuelta;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="incidencias")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    
    private $usuario;

    
    
    public function __construct()
    {
        $this->usuario = new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getTitulo();
    }
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
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
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
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
     * Set hora
     *
     * @param time $hora
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    /**
     * Get hora
     *
     * @return time 
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set resuelta
     *
     * @param boolean $resuelta
     */
    public function setResuelta($resuelta)
    {
        $this->resuelta = $resuelta;
    }

    /**
     * Get resuelta
     *
     * @return boolean 
     */
    public function getResuelta()
    {
        return $this->resuelta;
    }

    /**
     * Set usuario
     *
     * @param Vecinos\IncidenciaBundle\Entity\Usuario $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get usuario
     *
     * @return Vecinos\IncidenciaBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}