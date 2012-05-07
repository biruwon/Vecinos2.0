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
     * @ORM\Column(type="string")
     */
    protected $fecha;
    
    /**
    *
    * @var array
    * @ORM\Column(name="archivos", type="array")
    *
    * 
    */
    
    protected $archivos;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $path;

    /**
     * @ORM\Column(type="time")
     */
    protected $hora;
    
    /**
     * @ORM\Column(type="string")
     */
   
    
    private $gravedad;


    /**
     * @var boolean $resuelta
     *
     * @ORM\Column(name="resuelta", type="boolean")
     */
    private $resuelta;

    /**
     * @ORM\ManyToOne(targetEntity="Vecinos\UsuarioBundle\Entity\Usuario")
     */
    
    private $usuario;

    
    
    public function __construct()
    {
        $this->archivos = new ArrayCollection();
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
     * @return Vecinos\UsuarioBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    /**
     * Set archivos
     *
     * @param string $archivos
     */
    public function setArchivos($archivos)
    {
        $this->archivos = $archivos;
    }

    /**
     * Get archivos
     *
     * @return string 
     */
    public function getArchivos()
    {
        return $this->archivos;
    }
     
    /**
     * Sube la foto de la oferta copiándola en el directorio que se indica y
     * guardando en la entidad la ruta hasta la foto
     *
     * @param string $directorioDestino 
     */
   /* public function subirFoto($directorioDestino)
    {
        if (null === $this->foto) {
            return;
        }
        //$directorioDestino = __DIR__.'/../../../../web/uploads/images';
        $nombreArchivoFoto = uniqid('vecinos-').'-foto.jpg';
        
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        
        $this->setFoto($nombreArchivoFoto);
    }
    */

    /**
     * Set path
     *
     * @param text $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return text 
     */
    public function getPath()
    {
        return $this->path;
    }
    
    
    
    
     public function uploadVarios()
    {        
        $mypath = unserialize($this->path);

        foreach ($this->archivos as $key => $value) {
            
            if ($value){
            
                //Definir un nombre valido para el archivo
                //Gedmo es una de las extensiones de Doctrine para Sluggable, Timestampable, etc
                $nombre = \Gedmo\Sluggable\Util\Urlizer::urlize($value->getClientOriginalName(), '-');

                //Verificar la extension para guardar la imagen
                $extension = $value->guessExtension();
                
                $extvalidas = array('JPG','JPEG','PNG','GIF','PDF');
                
                if ( !in_array(strtoupper($extension), $extvalidas)){
                    return;
                }
                
                
                
                //Quitar la extension del nombre generado
                //caso contrario el nombre queda algo como:  miimagen-jpg
                $nombre = str_replace('-'.$extension, '', $nombre);
                
                //Nombre final con extension
                //Queda algo como: miimagen.jpg
                $nombreFinal = $nombre.'.'.$extension;
                
                //Verificar si la imagen ya esta almacenada
                if (@in_array($nombreFinal, $mypath)){
                    //si la imagen ya esta almacenada, se continua con el siguiente item    
                    continue;
                }
                
                //Almacenar la imagen en el servidor
                $value->move($this->getUploadRootDir(), $nombreFinal);
                
            //Agregar el nuevo nombre al final del Array
                $mypath[]= $nombreFinal;
            }
        }
        $this->path = serialize($mypath);
        $this->archivos = array();
    } 
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/images';
    }
}