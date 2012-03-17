<?php

namespace Vecinos\EspacioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vecinos\EspacioBundle\Entity\Espacio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\EspacioBundle\Entity\EspacioRepository")
 */
class Espacio
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