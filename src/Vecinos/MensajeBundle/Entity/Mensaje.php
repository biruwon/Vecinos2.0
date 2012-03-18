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


    private $emisor;
    
    private $receptor;
    
    private $texto;


    
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}