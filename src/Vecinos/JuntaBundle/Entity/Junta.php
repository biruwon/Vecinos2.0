<?php

namespace Vecinos\JuntaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Vecinos\JuntaBundle\Entity\Junta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\JuntaBundle\Entity\JuntaRepository")
 */
class Junta
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
     *
     * @ORM\ManyToMany(targetEntity="Vecinos\UsuarioBundle\Entity\Usuario", inversedBy="juntas", cascade={"persist"})
     * @ORM\JoinTable(name="junta_usuario",
     *		joinColumns={@ORM\JoinColumn(name="junta_id", referencedColumnName="id")},
     *		inverseJoinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")}
     *		)
     */

    protected $usuarios;
    
    /**
     * @ORM\Column(type="string")
     */
    private $titulo;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $descripcion;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $fecha;
    
    /**
     * @ORM\Column(type="time")
     */
    protected $hora1;
    
    /**
     * @ORM\Column(type="time")
     */
    protected $hora2;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $lugar;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $path;
    
    
    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
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
     * Set lugar
     *
     * @param string $lugar
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }
    
    /**
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
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
     * Set hora1
     *
     * @param time $hora1
     */
    public function setHora1($hora1)
    {
        $this->hora1 = $hora1;
    }

    /**
     * Get hora1
     *
     * @return time 
     */
    public function getHora1()
    {
        return $this->hora1;
    }
    
    /**
     * Set hora2
     *
     * @param time $hora2
     */
    public function setHora2($hora2)
    {
        $this->hora2 = $hora2;
    }

    /**
     * Get hora2
     *
     * @return time 
     */
    public function getHora2()
    {
        return $this->hora2;
    }

    /**
     * Set usuarios
     *
     * @param Vecinos\UsuarioBundle\Entity\Usuario $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Get usuarios
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}