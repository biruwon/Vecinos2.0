<?php

namespace Vecinos\ReservaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vecinos\ReservaBundle\Entity\Reserva
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\ReservaBundle\Entity\ReservaRepository")
 */
class Reserva
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