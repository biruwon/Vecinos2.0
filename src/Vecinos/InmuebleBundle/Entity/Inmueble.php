<?php

namespace Vecinos\InmuebleBundle\Entity;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}