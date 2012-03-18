<?php

namespace Vecinos\InmuebleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vecinos\InmuebleBundle\Entity\Inmueble
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\InmuebleBundle\Entity\InmuebleRepository")
 */
class Inmueble
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
     * @var integer $num_personas
     *
     * @ORM\Column(name="num_personas", type="integer")
     */
    private $num_personas;

    /**
     * @var boolean $ocupado
     *
     * @ORM\Column(name="ocupado", type="boolean")
     */
    private $ocupado;

    /**
     * @var string $via
     *
     * @ORM\Column(name="via", type="string", length=100)
     */
    private $via;
    
    /**
     * @var string $nombre_via
     *
     * @ORM\Column(name="nombre_via", type="string", length=255)
     */
    private $nombre_via;

    /**
     * @var integer $numero
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

    /**
     * @var integer $bloque
     *
     * @ORM\Column(name="bloque", type="integer")
     */
    private $bloque;

    /**
     * @var string $puerta
     *
     * @ORM\Column(name="puerta", type="string", length=1)
     */
    private $puerta;

    /**
     * @var integer $planta
     *
     * @ORM\Column(name="planta", type="integer")
     */
    private $planta;

    /**
     * @var string $nombre_propietario
     *
     * @ORM\Column(name="nombre_propietario", type="string", length=255)
     */
    private $nombre_propietario;

    /**
     * @var integer $habitaciones
     *
     * @ORM\Column(name="habitaciones", type="integer")
     */
    private $habitaciones;

    /**
     * 
     *
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="inmuebles", cascade={"persist"})
     * @ORM\JoinTable(name="inmueble_usuario",
     *		joinColumns={@ORM\JoinColumn(name="inmueble_id", referencedColumnName="id")},
     *		inverseJoinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")}
     *		)
     */
    private $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
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
     * Set num_personas
     *
     * @param integer $numPersonas
     */
    public function setNumPersonas($numPersonas)
    {
        $this->num_personas = $numPersonas;
    }

    /**
     * Get num_personas
     *
     * @return integer 
     */
    public function getNumPersonas()
    {
        return $this->num_personas;
    }

    /**
     * Set ocupado
     *
     * @param boolean $ocupado
     */
    public function setOcupado($ocupado)
    {
        $this->ocupado = $ocupado;
    }

    /**
     * Get ocupado
     *
     * @return boolean 
     */
    public function getOcupado()
    {
        return $this->ocupado;
    }

    /**
     * Set via
     *
     * @param string $via
     */
    public function setVia($via)
    {
        $this->via = $via;
    }

    /**
     * Get via
     *
     * @return string 
     */
    public function getVia()
    {
        return $this->via;
    }
    
    /**
     * Set nombre_via
     *
     * @param string $nombreVia
     */
    public function setNombreVia($nombreVia)
    {
        $this->nombre_via = $nombreVia;
    }

    /**
     * Get nombre_via
     *
     * @return string 
     */
    public function getNombreVia()
    {
        return $this->nombre_via;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set bloque
     *
     * @param integer $bloque
     */
    public function setBloque($bloque)
    {
        $this->bloque = $bloque;
    }

    /**
     * Get bloque
     *
     * @return integer 
     */
    public function getBloque()
    {
        return $this->bloque;
    }

    /**
     * Set puerta
     *
     * @param string $puerta
     */
    public function setPuerta($puerta)
    {
        $this->puerta = $puerta;
    }

    /**
     * Get puerta
     *
     * @return string 
     */
    public function getPuerta()
    {
        return $this->puerta;
    }

    /**
     * Set planta
     *
     * @param integer $planta
     */
    public function setPlanta($planta)
    {
        $this->planta = $planta;
    }

    /**
     * Get planta
     *
     * @return integer 
     */
    public function getPlanta()
    {
        return $this->planta;
    }

    /**
     * Set nombre_propietario
     *
     * @param string $nombrePropietario
     */
    public function setNombrePropietario($nombrePropietario)
    {
        $this->nombre_propietario = $nombrePropietario;
    }

    /**
     * Get nombre_propietario
     *
     * @return string 
     */
    public function getNombrePropietario()
    {
        return $this->nombre_propietario;
    }

    /**
     * Set habitaciones
     *
     * @param integer $habitaciones
     */
    public function setHabitaciones($habitaciones)
    {
        $this->habitaciones = $habitaciones;
    }

    /**
     * Get habitaciones
     *
     * @return integer 
     */
    public function getHabitaciones()
    {
        return $this->habitaciones;
    }

    /**
     * Set usuarios
     *
     * @param Vecinos\InmuebleBundle\Usuario $usuarios
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    /**
     * Get usuarios
     *
     * @return Doctrine\Common\Collections\Collection $usuarios
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
   

}