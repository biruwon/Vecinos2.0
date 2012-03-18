<?php

namespace Vecinos\JuntaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vecinos\JuntaBundle\Entity\Junta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vecinos\JuntaBundle\Entity\JuntaRepository")
 */
class Junta
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $apuntarse;
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