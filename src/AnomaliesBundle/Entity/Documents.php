<?php

namespace AnomaliesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documents
 *
 * @ORM\Table(name="ar_documents")
 * @ORM\Entity(repositoryClass="AnomaliesBundle\Entity\DocumentsRepository")
 */
class Documents
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

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
     * Set name
     *
     * @param string $name
     * @return Documents
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Documents
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return Documents
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string 
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     * @return Documents
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
    
    ############################# START M-TO-M documents<->processanomalies #################################
    /**
     * @ORM\ManyToMany(targetEntity="Processanomalies", mappedBy="fkdocuments")
     *
     */
    private $processanomalies;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->processanomalies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add processanomalies
     *
     * @param \AnomaliesBundle\Entity\Processanomalies $processanomalies
     * @return Documents
     */
    public function addProcessanomaly(\AnomaliesBundle\Entity\Processanomalies $processanomalies)
    {
        $this->processanomalies[] = $processanomalies;

        return $this;
    }

    /**
     * Remove processanomalies
     *
     * @param \AnomaliesBundle\Entity\Processanomalies $processanomalies
     */
    public function removeProcessanomaly(\AnomaliesBundle\Entity\Processanomalies $processanomalies)
    {
        $this->processanomalies->removeElement($processanomalies);
    }

    /**
     * Get processanomalies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProcessanomalies()
    {
        return $this->processanomalies;
    }
    
   ############################# END M-TO-M  documents<->processanomalies #################################
}
