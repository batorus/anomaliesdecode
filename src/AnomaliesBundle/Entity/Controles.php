<?php

namespace AnomaliesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Controles
 *
 * @ORM\Table(name="ar_controles")
 * @ORM\Entity(repositoryClass="AnomaliesBundle\Entity\ControlesRepository")
 */
class Controles
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
     * @ORM\ManyToMany(targetEntity="Typecontrole", inversedBy="controles")
     * @ORM\JoinTable(name="controles_typecontroles")
     */
    private $fktypecontroles;

    
//    /**
//     * @ORM\ManyToMany(targetEntity="Typesociete", inversedBy="controles")
//     * @ORM\JoinTable(name="controles_typesocietes")
//     */
//    private $fktypesocietes;
//    
//    /**
//     * @ORM\ManyToMany(targetEntity="Typetaches", inversedBy="controles")
//     * @ORM\JoinTable(name="controles_typetaches")
//     */
//    private $fktypetaches;
    
    

    /**
     * @var string
     *
     * @ORM\Column(name="controle", type="string", length=255, options={"collation":"utf8_general_ci"}, unique=true)
     */
    private $controle;

    /**
     * @var string
     *
     * @ORM\Column(name="echantillon", type="string", length=255, options={"collation":"utf8_general_ci"}, unique=true)
     */
    private $echantillon;


 
   

    /**
     * @var string
     *
     * @ORM\Column(name="periodetravaux", type="string", length=255, options={"collation":"utf8_general_ci"}, unique=true)
     */
    private $periodetravaux;

    
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
     * Set controle
     *
     * @param string $controle
     * @return Controles
     */
    public function setControle($controle)
    {
        $this->controle = $controle;

        return $this;
    }

    /**
     * Get controle
     *
     * @return string 
     */
    public function getControle()
    {
        return $this->controle;
    }

    /**
     * Set echantillon
     *
     * @param string $echantillon
     * @return Controles
     */
    public function setEchantillon($echantillon)
    {
        $this->echantillon = $echantillon;

        return $this;
    }

    /**
     * Get echantillon
     *
     * @return string 
     */
    public function getEchantillon()
    {
        return $this->echantillon;
    }
    

    
    

    /**
     * Set periodetravaux
     *
     * @param string $periodetravaux
     * @return Controles
     */
    public function setPeriodetravaux($periodetravaux)
    {
        $this->periodetravaux = $periodetravaux;

        return $this;
    }

    /**
     * Get periodetravaux
     *
     * @return string 
     */
    public function getPeriodetravaux()
    {
        return $this->periodetravaux;
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
        $this->fktypecontroles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fktypecontrole
     *
     * @param \AnomaliesBundle\Entity\Typecontrole $fktypecontrole
     *
     * @return Controles
     */
    public function addFktypecontrole(\AnomaliesBundle\Entity\Typecontrole $fktypecontrole)
    {
        $this->fktypecontroles[] = $fktypecontrole;

        return $this;
    }

    /**
     * Remove fktypecontrole
     *
     * @param \AnomaliesBundle\Entity\Typecontrole $fktypecontrole
     */
    public function removeFktypecontrole(\AnomaliesBundle\Entity\Typecontrole $fktypecontrole)
    {
        $this->fktypecontroles->removeElement($fktypecontrole);
    }

    /**
     * Get fktypecontroles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFktypecontroles()
    {
        return $this->fktypecontroles;
    }
}
