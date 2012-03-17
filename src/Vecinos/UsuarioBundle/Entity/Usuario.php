<?php

namespace Vecinos\UsuarioBundle\Entity;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}