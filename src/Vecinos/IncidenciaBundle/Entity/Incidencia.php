<?php

namespace Vecinos\IncidenciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

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
    * @ORM\Column(type="string")
    *
    * @Assert\Image(maxSize = "500k")
    */
    
    protected $foto;

    /**
     * @ORM\Column(type="time")
     */
    protected $hora;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\Choice(choices= {"leve","media","grave"})
     */
   
    
    private $gravedad;


    /**
     * @var boolean $resuelta
     *
     * @ORM\Column(name="resuelta", type="boolean")
     */
    private $resuelta;

    /**
     * @ORM\ManyToOne(targetEntity="Vecinos\UsuarioBundle\Entity\Usuario", inversedBy="incidencias", cascade={"persist"})
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    
    private $usuario;

    
    
    public function __construct()
    {
        //$this->usuario = new ArrayCollection();
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
     * Set gravedad
     *
     * @param string $gravedad
     */
    public function setGravedad($gravedad)
    {
        $this->gravedad = $gravedad;
    }

    /**
     * Get gravedad
     *
     * @return string 
     */
    public function getGravedad()
    {
        return $this->gravedad;
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
     * @param Vecinos\UsuarioBundle\Entity\Usuario $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get usuario
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    /**
     * Set foto
     *
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }
     
    /**
     * Sube la foto de la oferta copiándola en el directorio que se indica y
     * guardando en la entidad la ruta hasta la foto
     *
     * @param string $directorioDestino Ruta completa del directorio al que se sube la foto
     */
    public function subirFoto($directorioDestino)
    {
        if (null === $this->foto) {
            return;
        }
        //$directorioDestino = __DIR__.'/../../../../web/uploads/images';
        $nombreArchivoFoto = uniqid('vecinos-').'-foto1.jpg';
        
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        
        $this->setFoto($nombreArchivoFoto);
    }
    
}