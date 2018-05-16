<?php

namespace AnomaliesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typetaches
 *
 * @ORM\Table(name="ar_typetaches")
 * @ORM\Entity(repositoryClass="AnomaliesBundle\Entity\TypetachesRepository")
 */
class Typetaches
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
     * @ORM\ManyToMany(targetEntity="Controles", mappedBy="fktypetaches")
     *
     */
    private $controles;   
    

    /**
     * @var string
     *
     * @ORM\Column(name="typetache", type="string", length=100, options={"collation":"utf8_general_ci"}, unique=true)
     */
    private $typetache;

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
     * Set typetache
     *
     * @param string $typetache
     * @return Typetaches
     */
    public function setTypetache($typetache)
    {
        $this->typetache = $typetache;

        return $this;
    }

    /**
     * Get typetache
     *
     * @return string 
     */
    public function getTypetache()
    {
        return $this->typetache;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     * @return Typetaches
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
     * @return Typetaches
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
