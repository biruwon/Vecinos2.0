<?php

namespace Vecinos\MensajeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vecinos\MensajeBundle\Entity\Mensaje
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\MensajeBundle\Entity\MensajeRepository")
 */
class Mensaje
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
     * @ORM\ManyToOne(targetEntity="Vecinos\UsuarioBundle\Entity\Usuario", inversedBy="mensaje_enviado")
     * @ORM\JoinColumn(name="emisor_id", referencedColumnName="id")
     */
    private $emisor;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Vecinos\UsuarioBundle\Entity\Usuario", inversedBy="mensaje_recibido")
     * @ORM\JoinColumn(name="receptor_id", referencedColumnName="id")
     */
    private $receptor;
    
    
    /**
     * @ORM\Column(type="text")
     */
    protected $texto;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $fecha;
    
    /**
     * @ORM\Column(type="time")
     */
    protected $hora;



    
    
    
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
     * Set texto
     *
     * @param text $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * Get texto
     *
     * @return text 
     */
    public function getTexto()
    {
        return $this->texto;
    }
    
    
    /**
     * Set emisor
     *
     * @param Vecinos\UsuarioBundle\Entity\Usuario $emisor
     */
    public function setEmisor($emisor)
    {
        $this->emisor = $emisor;
    }

    /**
     * Get emisor
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getEmisor()
    {
        return $this->emisor;
    }
    
    /**
     * Set receptor
     *
     * @param Vecinos\UsuarioBundle\Entity\Usuario $receptor
     */
    public function setReceptor($receptor)
    {
        $this->receptor = $receptor;
    }

    /**
     * Get receptor
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getReceptor()
    {
        return $this->receptor;
    }
    
    
    
}