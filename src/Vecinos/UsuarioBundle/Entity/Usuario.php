<?php

namespace Vecinos\UsuarioBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vecinos\UsuarioBundle\Entity\Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\UsuarioBundle\Entity\UsuarioRepository")
 */
class Usuario
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
     * @ORM\OneToMany(targetEntity="Vecinos\IncidenciaBundle\Entity\Incidencia", mappedBy="usuario")
     */
    
    private $incidencias;
    
    /**
    * @ORM\ManyToMany(targetEntity="Vecinos\JuntaBundle\Entity\Junta", mappedBy="usuarios")
    */
    
    private $juntas;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string $apellidos
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
    /**
     * @var string salt
     *
     * @ORM\Column(name="salt", type="string", length="255")
     */
    protected $salt;

    /**
     * @var text $direccion
     *
     * @ORM\Column(name="direccion", type="text")
     */
    private $direccion;
    
    /**
     * @var boolean $permite_email
     *
     * @ORM\Column(name="permite_email", type="boolean")
     */
    private $permite_email;
    
    /**
     * @var datetime $fecha_nacimiento
     *
     * @ORM\Column(name="fecha_nacimiento", type="datetime")
     */
    private $fecha_nacimiento;

    /**
     * @var string $dni
     *
     * @ORM\Column(name="dni", type="string", length=9)
     */
    private $dni;

    /**
     * @var string $ciudad
     *
     * @ORM\Column(name="ciudad", type="string", length=255)
     */
    private $ciudad;

    /**
     * @ORM\ManyToMany(targetEntity="Vecinos\InmuebleBundle\Entity\Inmueble", mappedBy="usuarios", cascade={"persist"})
     */
    private $inmuebles;
    
    /**
     * @ORM\OneToOne(targetEntity="Vecinos\ReservaBundle\Entity\Reserva", inversedBy="usuario")
     * @ORM\JoinColumn(name="reserva_id", referencedColumnName="id")
     */
    
    private $reservas;
    
    /**
     * @ORM\OneToMany(targetEntity="Vecinos\MensajeBundle\Entity\Mensaje", mappedBy="emisor")
     */
 
    private $mensaje_enviado;

    
    /**
     * @ORM\OneToMany(targetEntity="Vecinos\MensajeBundle\Entity\Mensaje", mappedBy="receptor")
     */
 
    private $mensaje_recibido;
    
    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
        $this->incidencias = new ArrayCollection();
        $this->juntas= new ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->getNombre().' '.$this->getApellidos();
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
     * Set apellidos
     *
     * @param string $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set direccion
     *
     * @param text $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Get direccion
     *
     * @return text 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set permite_email
     *
     * @param boolean $permiteEmail
     */
    public function setPermiteEmail($permiteEmail)
    {
        $this->permite_email = $permiteEmail;
    }

    /**
     * Get permite_email
     *
     * @return boolean 
     */
    public function getPermiteEmail()
    {
        return $this->permite_email;
    }
    
    /**
     * Set fecha_nacimiento
     *
     * @param datetime $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fecha_nacimiento = $fechaNacimiento;
    }

    /**
     * Get fecha_nacimiento
     *
     * @return datetime 
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * Set dni
     *
     * @param string $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set inmuebles
     *
     * @param Vecinos\InmuebleBundle\Entity\Inmueble $inmuebles
     */

    public function setInmuebles($inmuebles)
    {
        $this->inmuebles = $inmuebles;
    }

    /**
     * Get inmuebles
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getInmuebles()
    {
        return $this->inmuebles;
    }
    
    /**
     * Set incidencias
     *
     * @param Vecinos\IncidenciaBundle\Entity\Incidencia $incidencias
     */
    public function setIncidencias($incidencias)
    {
        $this->incidencias = $incidencias;
    }

    /**
     * Get incidencias
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getIncidencias()
    {
        return $this->incidencias;
    }
    
    /**
     * Get juntas
     *
     * @param Vecinos\JuntaBundle\Entity\Junta $juntas 
     */
    public function setJuntas()
    {
        $this->juntas = $juntas;
    }

    /**
     * Get juntas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getJuntas()
    {
        return $this->ponencias;
    }
    
    /**
     * Get mensaje_enviado
     *
     * @param Vecinos\MensajeBundle\Entity\Mensaje $mensaje_enviado 
     */
    public function setMensaje_enviado()
    {
        $this->mensaje_enviado = $mensaje_enviado;
    }

    /**
     * Get mensaje_enviado
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMensaje_enviado()
    {
        return $this->mensaje_enviado;
    }
    
    /**
     * Get mensaje_recibido
     *
     * @param Vecinos\MensajeBundle\Entity\Mensaje $mensaje_recibido 
     */
    public function setMensaje_recibido()
    {
        $this->mensaje_recibido = $mensaje_recibido;
    }

    /**
     * Get mensaje_recibido
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMensaje_recibido()
    {
        return $this->mensaje_recibido;
    }
    
    /**
     * Get reservas
     *
     * @param Vecinos\ReservaBundle\Entity\Reserva $reservas 
     */
    public function setReservas()
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