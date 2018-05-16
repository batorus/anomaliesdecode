<?php

namespace AnomaliesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typesociete
 *
 * @ORM\Table(name="ar_typesociete")
 * @ORM\Entity(repositoryClass="AnomaliesBundle\Entity\TypesocieteRepository")
 */
class Typesociete
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToMany(targetEntity="Controles", mappedBy="fktypesocietes")
     *
     */
    private $controles;

    /**
     * @var string
     *
     * @ORM\Column(name="typesociete", type="string", length=100, options={"collation":"utf8_general_ci"}, unique=true)
     */
    private $typesociete;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer")
     */
    private $enabled;


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
     * Set typesociete
     *
     * @param string $typesociete
     * @return Typesociete
     */
    public function setTypesociete($typesociete)
    {
        $this->typesociete = $typesociete;

        return $this;
    }

    /**
     * Get typesociete
     *
     * @return string 
     */
    public function getTypesociete()
    {
        return $this->typesociete;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     * @return Typesociete
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->controles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add controle
     *
     * @param \AnomaliesBundle\Entity\Controles $controle
     *
     * @return Typesociete
     */
    public function addControle(\AnomaliesBundle\Entity\Controles $controle)
    {
        $this->controles[] = $controle;

        return $this;
    }

    /**
     * Remove controle
     *
     * @param \AnomaliesBundle\Entity\Controles $controle
     */
    public function removeControle(\AnomaliesBundle\Entity\Controles $controle)
    {
        $this->controles->removeElement($controle);
    }

    /**
     * Get controles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getControles()
    {
        return $this->controles;
    }
}
