<?php

namespace Vecinos\IncidenciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}