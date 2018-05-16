<?php

namespace AnomaliesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typecontrole
 *
 * @ORM\Table(name="ar_typecontrole")
 * @ORM\Entity(repositoryClass="AnomaliesBundle\Entity\TypecontroleRepository")
 */
class Typecontrole
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
     * @ORM\ManyToMany(targetEntity="Controles", mappedBy="fktypecontroles")
     *
     */
    private $controles;

    /**
     * @var string
     *
     * @ORM\Column(name="typecontrole", type="string", options={"collation":"utf8_general_ci"}, unique=true)
     */
    private $typecontrole;

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
     * Set typecontrole
     *
     * @param string $typecontrole
     * @return Typecontrole
     */
    public function setTypecontrole($typecontrole)
    {
        $this->typecontrole = $typecontrole;

        return $this;
    }

    /**
     * Get typecontrole
     *
     * @return string 
     */
    public function getTypecontrole()
    {
        return $this->typecontrole;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     * @return Typecontrole
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
     * @return Typecontrole
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
