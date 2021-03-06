<?php

namespace UNTDF\ReservasAulasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use UNTDF\ReservasAulasBundle\Entity\Curso;

/**
 * Carrera
 * @ORM\Table(name="carrera")
 * @ORM\Entity
 */
class Carrera
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="Curso")
     **/
    private $cursos;


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
     * @return Carrera
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
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

    public function getCursos()
    {
        return $this->cursos;
    }

    public function __construct()
    {
        $this->cursos = new ArrayCollection();        
    }

    public function obtenerListaCursos(){
        $listacursos = '';
        foreach ($this->cursos as $curso) {
            if($listacursos <> ''){
                $listacursos = $listacursos . ', ';     
            }
            $listacursos = $listacursos . $curso->getNombre();
            $listacursos = trim($listacursos);
        }
        return $listacursos;
    }
    
    public function __toString()
    {
        return $this->getNombre();
    }

}
